<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Articletheme extends Model
{
    use HasFactory;
    public function articles() {
        return $this->hasMany(Article::class);
    }
}
