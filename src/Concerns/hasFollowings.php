<?php
namespace Larafa\UserProfile;

use App\User;
use Larafa\UserProfile\Following;
use Illuminate\Support\Facades\DB;

trait hasFollowings {
	/**
     * Add follower to the user
     *
     * @param User $user
     * @return $this
     */
    public function addFollower(User $user)
    {
        // check if the user is already a follower
        if ($this->hasFollower($user)) {return $this;}

        $following = new Following([
            'user_id'=>$this->id,
            'follower_id'=>$user->id,
        ]);
        $following->save();

        return $this;
    }


    /**
     * Add multiple followers to the user
     *
     * @param array $users
     * @return $this
     */
    public function addFollowers(Array $users)
    {
        foreach ($users as $user)
        {
            $this->addFollower($user);
        }

        return $this;
    }


    /**
     * Return the followers of the user
     *
     * @return array
     */
    public function followers()
    {
    	return $this->belongsToMany(User::class , 'followings' , 'user_id', 'follower_id');
    }

    /**
     * Returns the array of users which this user follows
     *
     * @param bool $onlyId
     * @return array
     */
    public function followings(/*$onlyId=false*/)
    {
    	return $this->belongsToMany(User::class , 'followings' , 'follower_id', 'user_id');
    }

    public function followingsKeys()
    {
    	$users = $this->followings()->get(['user_id', 'name'])->toArray();
    	$ids = [];
    	foreach ($users as $user) {
    		$ids[] = $user['user_id'];
    	}
    	return $ids;

    }
/**
     * @return int
     */
    public function getFollowingsNumber()
    {
        return count($this->followings);
    }

    /**
     * @return int
     */
    public function getFollowersNumber()
    {
        return count($this->followers);
    }

    /**
     * Check if the model has the given user among its followers
     *
     * @param User $user
     * @return bool
     */
    public function hasFollower(User $user)
    {
        $f = DB::table('followings')->where('user_id',$this->id)
            ->where('follower_id',$user->id)
            ->get();
        return (count($f)>0);
    }

    public function removeFollower(User $user)
    {
        $followings = Following::all()->where('user_id',$this->id)
            ->where('follower_id',$user->id)->all();
        if (count($followings)==0){return $this;}
        foreach ($followings as $following)
        {
            $following->delete();
        }
        return $this;
    }
}