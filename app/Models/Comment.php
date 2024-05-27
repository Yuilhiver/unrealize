<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $with = ['user:id,avatar,login'];

    protected $fillable = [
        'content',
        'work_id',
        'user_id',
        'rating',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
