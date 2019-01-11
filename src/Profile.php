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
    	return $this->hasOne(\App\User::class, 'id', 'user_id')->get();
    }

    public function getAvatarPathAttribute($value)
    {
        if ($value == null) {return null;}
        return Storage::url($value);
    }

    public function getAvatarUrlAttribute()
    {
        if ($this->avatar_path ==null) {return null;}
        return url($this->avatar_path);
    }

}
