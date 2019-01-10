<?php

namespace Larafa\UserProfile\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;

class UserServiceController extends Controller
{
    protected $filterables = ['name', 'email', 'country', 'city'];
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
        $users = $this->filter($users, $request);
        $users = $this->include($users, $request);
        return $users;


    }

    protected function filter(Builder $users, Request $request)
    {
        $filters = json_decode($request->filters , true);
        if (! is_array($filters)) {return $users;}
        $this->applyFilters($users , $filters);
        return $users;
    }

    protected function applyFilters(Builder $users, Array $filters)
    {
        // If the value is not an array then the query would be added
        foreach ($filters as $key => $value) {
            if (! in_array($key , $this->filterables)){continue;}
            $users = (is_array($value))?$users:$users->where($key, 'like', '%'.$value.'%');
        }
    }

    public function include(Builder $users, Request $request)
    {
        $include = json_decode($request->include , true);
        if (! is_array($include)) {return $users->get();}
        return $users->get($include);
    }
}
