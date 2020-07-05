<?php

namespace App\Policies;

use App\User;
use App\Order;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrderPolicy
{
    use HandlesAuthorization;

    public function devolutionOrder(User $user)
    {
        return $user;
        //return $user->id === $item->OwnerID;
    }
}
