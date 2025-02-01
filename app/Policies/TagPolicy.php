<?php

namespace App\Policies;

use App\Models\Tag;
use App\Models\User;
class TagPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

 /**
     * Determine whether the user can create tags.
     *
     * @param \App\Models\User $user
     * @return bool
     */
    public function modifyTags(User $user)
    {
        return $user->isAdmin(); 
    }

    
}