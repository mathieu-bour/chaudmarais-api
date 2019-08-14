<?php


namespace Tests\API;


use App\Models\User;
use Jose\Component\Signature\JWS;
use Jose\Component\Signature\Serializer\CompactSerializer;
use Jose\Component\Signature\Serializer\Serializer;
use Mathrix\Lumen\Zero\Testing\Traits\DebugTrait;
use stdClass;
use Tests\TestCase;

/**
 * Class AuthTest.
 *
 * @author Mathieu Bour <mathieu@mathrix.fr>
 * @copyright Mathrix Education SA.
 * @since 1.0.0
 */
class AuthTest extends APIStatelessTestCase
{
    use DebugTrait;

    /**
     * POST /auth/login
     *
     * @throws \Exception
     */
    public function testLogin(): void
    {
        $user = User::random();

        $this->json("post", "/auth/login", [
            "email" => $user->email,
            "password" => "123456"
        ]);

        $this->assertResponseOk();

        /** @var stdClass $response */
        $response = json_decode($this->response->getContent());
        $this->assertTrue(isset($response->data->token));

        /** @var CompactSerializer $serializer */
        $serializer = app()->make(Serializer::class);
        /** @var JWS $jws */
        $jws = $serializer->unserialize($response->data->token);
        /** @var stdClass $tokenPayload */
        $tokenPayload = json_decode($jws->getPayload());
        $this->assertEquals($user->id, $tokenPayload->sub);
    }
}
