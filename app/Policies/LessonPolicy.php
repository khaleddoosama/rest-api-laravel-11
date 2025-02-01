<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Lesson;
use Illuminate\Auth\Access\Response;

use Illuminate\Auth\Access\HandlesAuthorization;

class LessonPolicy
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
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\Lesson  $lesson
     * @return mixed
     */
    public function update(User $user, Lesson $lesson)
    {
        return $user->id === $lesson->user_id  || $user->role === "admin" 
        ? 
          Response::allow()
        : Response::deny('You do not have permission to perform this action.');
        
    }

    

    /**
     * Determine whether the user can delete the user.
     *
     * @param  \App\Models\User  $authUser
     * @return bool
     */
    public function delete(User $user, Lesson $lesson)
    {
        return $user->id === $lesson->user_id  || $user->role === "admin" 
        ? 
          Response::allow()
        : Response::deny('You do not have permission to perform this action.');
        
    }
}