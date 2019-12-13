<?php

namespace App\Policies;

use App\User;
use App\GiftList;
use Illuminate\Auth\Access\HandlesAuthorization;

class GiftListPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user has permissions.
     *
     * @param User $user
     * @param GiftList $giftList
     * @return mixed
     */
    public function userAllowed(User $user, GiftList $giftList)
    {
        return $user->id === $giftList->user_id;
    }
}
