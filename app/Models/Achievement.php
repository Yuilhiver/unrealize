<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Achievement extends Model
{
    use HasFactory;

    public function users() {
        return $this->belongsToMany(User::class,'achievement_user','achievement_id','user_id')->withPivot('created_at');
    }
    public function hasAchievement(User $user) {
        return $this->users->contains($user->id);
    }

}
