<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
class Work extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $withCount = ['comments'];

    protected $guarded = [
        'id',
        'updated_at',
        'created_at',
    ];

    public function comments() {
        return $this->hasMany(Comment::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function version() {
        return $this->hasOne(Version::class,'id','version_id');
    }


    public function workgenre() {
        return $this->belongsTo(Workgenre::class);
    }

    public function worktype() {
        return $this->belongsTo(Worktype::class);
    }

    public function registerMediaConversions(?Media $media = null): void
    {

        $this->addMediaConversion('thumb')
              ->width(720)
              ->height(576)
              ->sharpen(10)
              ->performOnCollections('works')
              ->nonQueued();

        $this->addMediaConversion('medium')
              ->width(1920)
              ->height(1080)
              ->performOnCollections('works')
              ->nonQueued();
    }
}
