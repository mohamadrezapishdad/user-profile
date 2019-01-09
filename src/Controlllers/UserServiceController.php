<?php

namespace Larafa\UserProfile\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class UserServiceController extends Controller
{
    protected $filterables = ['name', 'email'];
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
        $users = User::where('id', '>', 0);
        $filters = json_decode($request->filters , true);
        
        // If the value is not an array then the query would be added
        foreach ($filters as $key => $value) {
            if (! in_array($key , $this->filterables)){continue;}
            $users = (is_array($value))?$users:$users->where($key, 'like', '%'.$value.'%');
        }
        
        return $users->get();

    }
}
