<?php

namespace Larafa\UserProfile;

use Illuminate\Database\Eloquent\Model;

class Following extends Model
{
    protected $fillable = ['user_id','follower_id'];
}
