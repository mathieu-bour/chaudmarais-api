<?php

namespace App\Policies;

use App\Models\User;

/**
 * Class UsersPolicy.
 *
 * @author Mathieu Bour <mathieu@mathrix.fr>
 * @copyright Mathrix Education SA.
 * @since 1.0.0
 */
class UsersPolicy
{
    /**
     * Users get policy.
     *
     * @param User $requester
     * @param User $target
     *
     * @return bool
     */
    public function get(User $requester, User $target): bool
    {
        return $this->selfOrHasScope($requester, $target, "users:read");
    }


    /**
     * Permission to check if the target user is the requester himself, or if the requester got the right permission.
     *
     * @param User $requester
     * @param User $target
     * @param string $permission
     *
     * @return bool
     */
    private function selfOrHasScope(User $requester, User $target, string $permission): bool
    {
        return $requester->hasScope($permission) || $requester->id === $target->id;
    }


    /**
     * Users patch policy.
     *
     * @param User $requester
     * @param User $target
     *
     * @return bool
     */
    public function patch(User $requester, User $target): bool
    {
        return $this->selfOrHasScope($requester, $target, "users:write");
    }


    /**
     * Users delete policy.
     *
     * @param User $requester
     * @param User $target
     *
     * @return bool
     */
    public function delete(User $requester, User $target): bool
    {
        return $this->selfOrHasScope($requester, $target, "users:delete");
    }
}
