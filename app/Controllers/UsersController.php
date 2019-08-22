<?php

namespace App\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Mathrix\Lumen\Zero\Controllers\BaseController;
use Mathrix\Lumen\Zero\Responses\SuccessJsonResponse;
use Stripe\Customer;

/**
 * Class UsersController.
 *
 * @author Mathieu Bour <mathieu@mathrix.fr>
 * @copyright Mathrix Education SA.
 * @since 1.0.0
 */
class UsersController extends BaseController
{
    protected $with = [
        "rel:get:orders" => "stock.product"
    ];

    /**
     * POST /users
     * Register a new user in the application.
     *
     * @param Request $request
     *
     * @return SuccessJsonResponse
     */
    public function standardPost(Request $request): SuccessJsonResponse
    {
        $user = new User($request->all());

        $stripeCustomer = Customer::create([
            "name" => "{$user->first_name} {$user->last_name}",
            "email" => $user->email
        ]);

        $user->scopes = []; // Default scopes
        $user->stripe_id = $stripeCustomer->id;
        $user->save();

        return new SuccessJsonResponse($user);
    }
}
