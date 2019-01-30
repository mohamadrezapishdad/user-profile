<?php

namespace Larafa\UserProfile\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Larafa\UserProfile\Facades\UserServiceFacade as UserService;
use Illuminate\Support\Facades\DB;
use Larafa\UserProfile\UserRepository;

class UserWebserviceController extends Controller
{
    protected $repository;

    /**
     * UserWebserviceController constructor.
     * @param $repo
     */
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }


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
        $users = $this->repository->getQuery();
        $users = UserService::filter($users, json_decode($request->filters, true));
        $users = UserService::include($users, json_decode($request->include, true));
        return $users;
    }

    
}
