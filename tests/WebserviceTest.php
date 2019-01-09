<?php

namespace Tests\Feature;

use App\Http\Controllers\UserServiceController;
use App\User;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WebserviceTest extends TestCase
{
    public function testAddFollowingAndRemoveFollowing()
    {
        $user1 = factory(User::class)->create();
        $user2=factory(User::class)->create();

        Auth::login($user1);
        $response = $this->get('/services/follow/'.$user2->id);

        $this->assertEquals(1,$user1->getFollowingsNumber());
        $this->assertDatabaseHas('followings',[
            'user_id'=>$user2->id,
            'follower_id'=>$user1->id
        ]);

        $response = $this->get('/services/unfollow/'.$user2->id);
        $response->assertSee("1")
            ->assertStatus(200);
        $this->assertDatabaseMissing('followings',[
            'user_id'=>$user2->id,
            'follower_id'=>$user1->id
        ]);
    }

    public function testHasFollowing()
    {
        $user1 = factory(User::class)->create();
        $user2=factory(User::class)->create();
        $user1->addFollower($user2);

        Auth::login($user2);

        $response = $this->get('/services/hasfollowing/'.$user1->id);
        $response->assertSee("1");

    }

}
