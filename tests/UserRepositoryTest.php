<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Support\Facades\Auth;
use Larafa\UserProfile\Facades\UserRepositoryFacade as UserRepository;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserRepositoryTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testGetAllUsers()
    {
        $users = factory(User::class, 10)->create();
        $user = factory(User::class)->create();

        Auth::login($user);

        $this->assertCount(11,UserRepository::getModels()->all());

        $user->addFollowers([$users[0], $users[3]]);
        $this->assertCount(2,UserRepository::getModels(3)->all());

        Auth::login($users[0]);
        $this->assertEquals(1, count($users[0]->followings()->get()->all()));


    }
}
