<?php

namespace App\Policies;

use App\Gift;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class GiftPolicy
{
    use HandlesAuthorization;


    /**
     * Determine whether the user can view the gift.
     *
     * @param User $user
     * @param Gift $gift
     * @return mixed
     */
    public function change(User $user, Gift $gift)
    {
        return $user->id === $gift->giftList->user_id && !$gift->picked;
    }

}
