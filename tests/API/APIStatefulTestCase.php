<?php


namespace Tests\API;


use App\Models\User;
use FastRoute\Dispatcher;
use FastRoute\RouteCollector;
use Illuminate\Support\Str;
use Mathrix\Lumen\JWT\Auth\JWT;
use Mathrix\Lumen\JWT\Auth\Middleware\ScopeMiddleware;
use Mathrix\Lumen\Zero\Testing\Traits\DebugTrait;
use Mathrix\Lumen\Zero\Testing\Traits\RESTTrait;
use Tests\TestCase;
use function FastRoute\simpleDispatcher;

class APIStatefulTestCase extends TestCase
{
    use RESTTrait, DebugTrait;

    /** @var Dispatcher $dispatcher The Lumen Dispatcher */
    private $dispatcher;
    /** @var User $requester The request user */
    protected $requester;

    public function setUp(): void
    {
        parent::setUp();

        $this->handler("before.json", function (string $method, string $uri) {
            $scopes = $this->getScopes($method, $uri);

            if (empty($scopes)) {
                $this->requester = User::random();
                JWT::actingAs($this->requester);
            } else {
                $this->requester = JWT::withScopes($scopes[0]);
            }
        });
    }

    /**
     * Get the Lumen Dispatcher
     *
     * @return Dispatcher
     */
    protected function getDispatcher(): Dispatcher
    {
        if ($this->dispatcher === null) {
            $this->dispatcher = simpleDispatcher(function (RouteCollector $r) {
                foreach (app()->router->getRoutes() as $route) {
                    $r->addRoute($route["method"], $route["uri"], $route["action"]);
                }
            });
        }

        return $this->dispatcher;
    }

    protected function getScopes(string $method, string $uri): array
    {
        $method = mb_strtoupper($method);

        $result = $this->getDispatcher()->dispatch($method, $uri);

        if ($result[0] !== Dispatcher::FOUND || empty($result[1]["middleware"])) {
            return [];
        }

        foreach ($result[1]["middleware"] as $middleware) {
            if (Str::startsWith($middleware, ScopeMiddleware::$key . ":")) {
                return explode(
                    ",",
                    str_replace(
                        ScopeMiddleware::$key . ":",
                        "",
                        $middleware
                    )
                );
            }
        }

        return [];
    }
}
