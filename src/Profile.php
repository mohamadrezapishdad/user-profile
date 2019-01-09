<?php

namespace Larafa\UserProfile;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Profile extends Model
{
    protected $fillable= [
		'user_id',
		'about_me',
		'gender',
		'birthday',
		'country',
		'city',
		'avatar_path',
    ];

    protected $appends = ['avatar_url'];

    public function user()
    {
    	return $this->belongsTo(\App\User::class, 'user_id', 'id')->get();
    }

    public function getAvatarPathAttribute($value)
    {
        if ($value == null) {return null;}
        return Storage::url($value);
    }

    public function getAvatarUrlAttribute()
    {
        return url($this->avatar_path);
    }

}
