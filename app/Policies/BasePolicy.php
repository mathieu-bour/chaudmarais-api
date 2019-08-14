<?php

namespace App\Policies;

use App\Models\User;

/**
 * Class BasePolicy.
 *
 * @author Mathieu Bour <mathieu@mathrix.fr>
 * @copyright Mathrix Education SA.
 * @since 1.0.0
 */
abstract class BasePolicy
{
    /**
     * Permission to check if the target user is the requester himself, or if the requester got the right permission.
     *
     * @param User $requester
     * @param User $target
     * @param string $permission
     *
     * @return bool
     */
    protected function selfOrHasScope(User $requester, User $target, string $permission): bool
    {
        return $requester->hasScope($permission) || $requester->id === $target->id;
    }
}
