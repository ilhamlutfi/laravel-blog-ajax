<?php

namespace App\Policies;

use App\Models\Article;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ArticlePolicy
{
    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, $article): Response
    {
        // khusus owner dan pemilik artikel
        return $user->hasRole('owner') || $user->id == $article->user_id
        ? Response::allow()
            : Response::deny('You do not own this article.');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, $article): Response
    {
        // khusus owner dan pemilik artikel
        return $user->hasRole('owner') || $user->id == $article->user_id
            ? Response::allow()
            : Response::deny('You do not own this article.');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, $article): Response
    {
        // khusus owner dan pemilik artikel
        return $user->hasRole('owner') || $user->id == $article->user_id
            ? Response::allow()
            : Response::deny('You do not own this article.');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, $article): Response
    {
        // khusus owner
        return $user->hasRole('owner') ? Response::allow() : Response::deny('You do not own this article.');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, $article): Response
    {
        // khusus owner
        return $user->hasRole('owner') ? Response::allow() : Response::deny('You do not own this article.');
    }
}
