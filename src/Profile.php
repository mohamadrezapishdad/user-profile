<?php

namespace Larafa\UserProfile;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable= [
		'user_id',
		'about_me',
		'gender',
		'birthday',
		'country',
		'city',
		'avatar',
    ];

    public function user()
    {
    	return $this->belongsTo(\App\User::class, 'user_id', 'id')->get();
    }
}
