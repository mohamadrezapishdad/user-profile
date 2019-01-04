<?php
namespace Larafa\UserProfile;

trait hasProfile {
	
	public function profile()
    {
        return $model->hasOne(\App\Profile::class, 'id', 'user_id');
    }

    public static function create(array $attributes = [])
    {
        $user = static::query()->create($attributes);
        \Larafa\UserProfile\Profile::create([
            'user_id'=> $user->id
        ]);
        return $user;
    }
}