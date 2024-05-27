<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Work;
use Illuminate\Auth\Access\Response;

class WorkPolicy
{
    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Work $work): bool
    {
        return ((bool) $user->is_admin || $user->id === $work->user_id);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Work $work): bool
    {
        return ((bool) $user->is_admin || $user->id === $work->user_id);
    }
}
