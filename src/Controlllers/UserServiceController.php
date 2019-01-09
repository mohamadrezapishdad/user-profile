<?php

namespace Larafa\UserProfile\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

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

    public function getUsers($option)
    {
        $user = Auth::user();
        $users = $user->getUsers($option);
        return $users->paginate();
    }
}
