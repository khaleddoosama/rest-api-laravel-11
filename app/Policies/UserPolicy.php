<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;



      /**
     * Determine whether the user can delete the user.
     *
     * @param  \App\Models\User  $authUser
     * @return bool
     */
    public function show(User $authUser)
    {
        return $authUser->role === 'admin';
    }
    /**
     * Determine whether the user can create a new user.
     *
     * @return bool
     */
    public function create(User $authUser)
    {
        return $authUser->role === 'admin';
    }

   /**
 * Determine whether the user can update the user.
 *
 * @param \App\Models\User $authUser
 * @param \App\Models\User $userToUpdate
 * @return bool
 */
public function update(User $authUser, User $userToUpdate)
{
    // Allow if the user is updating their own information or if they are an admin
    return $authUser->id === $userToUpdate->id || $authUser->role === 'admin';
}

    

    /**
     * Determine whether the user can delete the user.
     *
     * @param  \App\Models\User  $authUser
     * @return bool
     */
    public function delete(User $authUser)
    {
        return $authUser->role === 'admin';
    }
}