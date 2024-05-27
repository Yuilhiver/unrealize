<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Workgenre extends Model
{
    use HasFactory;

    public function works() {
        return $this->hasMany(Work::class);
    }
    public function collaborations() {
        return $this->hasMany(Collaboration::class);
    }
}
