<?php

namespace Larafa\UserProfile;


use App\User;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;
use Larafa\UserProfile\Facades\UserServiceFacade as UserService;

class UserRepository
{
    const ALL_USERS = 1;
    const FOLLOWINGS = 2;
    const FOLLOWERS = 3;

    protected $authenticatedUser;
    protected $query;

    /**
     * UserRepository constructor.
     * @param $authenticatedUser
     */
    public function __construct(User $authenticatedUser)
    {
        $this->authenticatedUser = $authenticatedUser;

        $this->checkUserTraits();

    }

    /**
     * Set the query of the repository
     * @param int $option
     * @return void
     */
    public function setQuery($option)
    {
        $this->query = DB::table('users as u')->leftJoin('profiles as p', 'p.user_id', 'u.id');

        $this->checkAuthenticatedUser();
        if ($option == self::FOLLOWINGS){
            $this->query = $this->authenticatedUser->followings();
        }

        if ($option == self::FOLLOWERS){
            $this->query = $this->authenticatedUser->followers();
        }
    }

    /**
     * Get the query of the repository
     * @param int $option
     * @return Builder
     */
    public function getQuery($option = self::ALL_USERS)
    {
        $this->setQuery($option);
        return $this->query;
    }

    /**
     * Get the eloquent models based on the query
     * @return \Illuminate\Support\Collection
     */
    public function getModels($option = self::ALL_USERS)
    {
        return $this->getQuery($option)->get();
    }

    protected function checkUserTraits(): void
    {
        try {
            if (!UserService::hasTrait(User::class, hasProfile::getProfileTraitName())) {
                throw new \Exception(hasProfile::getProfileTraitName() . " trait is not used in the User model.");
            }
            if (!UserService::hasTrait(User::class, hasFollowings::getFollowingsTraitName())) {
                throw new \Exception(hasFollowings::getFollowingsTraitName() . " trait is not used in the User model.");
            }
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    protected function checkAuthenticatedUser(): void
    {
        try{
            if ($this->authenticatedUser == null) {
                throw new \Exception("Requester must be signed in");
            }
        }catch(\Exception $e){
            echo $e->getMessage();
        }

    }

}