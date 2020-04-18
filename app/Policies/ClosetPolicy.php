<?php

namespace App\Policies;

use App\User;
use App\Closet;
use Illuminate\Auth\Access\HandlesAuthorization;

class ClosetPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the closet.
     *
     * @param  \App\User  $user
     * @param  \App\Closet  $closet
     * @return mixed
     */
    public function viewCloset(User $user, Closet $closet)
    {
        return $user->id === $closet->UserID;
    }

    /**
     * Determine whether the user can create closets.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the closet.
     *
     * @param  \App\User  $user
     * @param  \App\Closet  $closet
     * @return mixed
     */
    public function updateCloset(User $user, Closet $closet)
    {
        return $user->id === $closet->UserID;
    }

    /**
     * Determine whether the user can delete the closet.
     *
     * @param  \App\User  $user
     * @param  \App\Closet  $closet
     * @return mixed
     */
    public function deleteCloset(User $user, Closet $closet)
    {
        return $user->id === $closet->UserID;
    }

    /**
     * Determine whether the user can restore the closet.
     *
     * @param  \App\User  $user
     * @param  \App\Closet  $closet
     * @return mixed
     */
    public function restore(User $user, Closet $closet)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the closet.
     *
     * @param  \App\User  $user
     * @param  \App\Closet  $closet
     * @return mixed
     */
    public function forceDelete(User $user, Closet $closet)
    {
        //
    }
}
