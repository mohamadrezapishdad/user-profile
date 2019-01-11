<?php
namespace Larafa\UserProfile;


use Larafa\UserProfile\Service;
use App\User;


class UserService extends Service
{
	protected $filterables = ['name', 'email', 'country', 'city'];
	
}