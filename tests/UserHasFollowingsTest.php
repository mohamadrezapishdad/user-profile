<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;

class UserHasFollowingsTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }

    public function testAddFollower()
    {
        $user1 = factory(User::class)->create();
        $user2 = factory(User::class)->create();

        $user1->addFollower($user2);

        $this->assertDatabaseHas('followings',[
            'user_id'=>$user1->id,
            'follower_id'=>$user2->id,
        ]);

        $user1->removeFollower($user2);
        $this->assertDatabaseMissing('followings',[
            'user_id'=>$user1->id,
            'follower_id'=>$user2->id,
        ]);
    }

    public function testAddFollowers()
    {
        $user1 = factory(User::class)->create();
        $users = factory(User::class, 3)->create()->all();

        $user1->addFollowers($users);

        $this->assertCount(1,$users[0]->followings);
        $this->assertCount(3, $user1->followers);
        $this->assertEquals([$user1->id], $users[0]->followingsKeys());

    }

    public function testHasFollower()
    {
        $user1 = factory(User::class)->create();
        $user2 = factory(User::class)->create();
        $user3 = factory(User::class)->create();

        $user1->addFollower($user2);

        $this->assertTrue($user1->hasFollower($user2));
        $this->assertFalse($user1->hasFollower($user3));
    }
}
