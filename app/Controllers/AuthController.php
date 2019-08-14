<?php


namespace App\Controllers;


use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Mathrix\Lumen\JWT\Auth\Exceptions\InvalidCredentialsException;
use Mathrix\Lumen\JWT\Auth\JWT\JWTIssuer;
use Mathrix\Lumen\Zero\Controllers\BaseController;
use Mathrix\Lumen\Zero\Exceptions\ValidationException;
use Mathrix\Lumen\Zero\Responses\SuccessJsonResponse;

class AuthController extends BaseController
{
    /**
     * POST /auth/login
     *
     * @param Request $request The Illuminate HTTP request.
     *
     * @return SuccessJsonResponse
     * @throws InvalidCredentialsException
     * @throws ValidationException
     * @throws Exception
     */
    public function login(Request $request): SuccessJsonResponse
    {
        $this->validate($request, [
            "email" => "required|email",
            "password" => "required"
        ]);

        /** @var User $user */
        $user = User::query()
            ->where("email", "=", $request->json("email"))
            ->get(["id", "password", "scopes"])
            ->first();

        if ($user === null) {
            throw new InvalidCredentialsException();
        }

        $logged = Hash::check($request->json("password"), $user->password);

        if (!$logged) {
            throw new InvalidCredentialsException();
        }

        $jws = JWTIssuer::issueJWS($user);

        return new SuccessJsonResponse([
            "token" => JWTIssuer::serializeJWS($jws)
        ]);
    }
}
