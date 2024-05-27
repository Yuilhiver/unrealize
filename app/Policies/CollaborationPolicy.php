<?php

namespace App\Policies;

use App\Models\Collaboration;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CollaborationPolicy
{
    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Collaboration $collaboration): bool
    {
        return ((bool) $user->is_admin || $user->id === $collaboration->user_id);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Collaboration $collaboration): bool
    {
        return ((bool) $user->is_admin || $user->id === $collaboration->user_id);
    }
}
