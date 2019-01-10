<?php

namespace Larafa\UserProfile\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Larafa\UserProfile\Facades\UserServiceFacade as UserService;
use Illuminate\Support\Facades\DB;

class UserServiceController extends Controller
{
    
    /**
     * The authenticated user follow a given user
     *
     * @param User $user
     * @return string
     */
    public function addFollowing(User $user)
    {
        $user->addFollower(Auth::user());
        return ('1');
    }

    /**
     * Check if the authenticated user is following the given user
     *
     * @param User $user
     * @return string
     */
    public function hasFollowing(User $user)
    {
        if ($user->hasFollower(Auth::user()))
        {
            return '1';
        }
        return '0';

    }

    /**
     * The authenticated user unfollow a user
     *
     * @param User $user
     * @return string
     */
    public function unfollow(User $user)
    {
        $user->removeFollower(Auth::user());
        return "1";
    }

    public function getUsers(Request $request, $option)
    {      
        $users = DB::table('users as u')->leftJoin('profiles as p', 'p.user_id', 'u.id');
        $users = UserService::filter($users, $request);
        $users = UserService::include($users, $request);
        return $users;
    }

    
}
