<?php

namespace App\Observers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

/**
 * Class UserObserver.
 *
 * @author Mathieu Bour <mathieu@mathrix.fr>
 * @copyright Mathrix Education SA.
 * @since 1.0.0
 */
class UserObserver
{
    /**
     * @param User $user
     *
     * @return bool
     */
    public function saving($user)
    {
        // Password hash
        if (isset($user->password) && Hash::needsRehash($user->password)) {
            $user->password = Hash::make($user->password);
        }

        return true;
    }
}
