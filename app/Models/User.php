<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class User extends Authenticatable implements HasMedia
{
    use HasFactory, Notifiable, InteractsWithMedia;

    protected $withCount = ['works'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'login',
        'email',
        'password',
        'avatar',
        'description',
        'background_image',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function works() {
        return $this->hasMany(Work::class);
    }

    public function achievements() {
        return $this->belongsToMany(User::class,'achievement_user','user_id','achievement_id')->withPivot('created_at');
    }

    public function followings() {
        return $this->belongsToMany(User::class,'follower_user','follower_id','user_id');
    }

    public function followers() {
        return $this->belongsToMany(User::class,'follower_user','user_id','follower_id');
    }

    public function follows(User $user) {
        return $this->followings->contains($user);
    }

    public function articles() {
        return $this->hasMany(Article::class);
    }

    public function collaborations() {
        return $this->hasMany(Collaboration::class);
    }

    public function getNoun($number, $one, $two, $five) {
        $n = abs($number);
        $n %= 100;
        if ($n >= 5 && $n <= 20) {
          return $five;
        }
        $n %= 10;
        if ($n == 1) {
          return $one;
        }
        if ($n >= 2 && $n <= 4) {
          return $two;
        }
        return $five;
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('thumb')
              ->performOnCollections('avatar')
              ->width(480)
              ->height(320)
              ->sharpen(10)
              ->nonQueued();

        $this->addMediaConversion('thumb')
              ->performOnCollections('background_image')
              ->width(1920)
              ->height(1080)
              ->sharpen(10)
              ->nonQueued();
    }
}
