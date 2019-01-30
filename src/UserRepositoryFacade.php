<?php

namespace Larafa\UserProfile\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Larafa\UserProfile\UserRepository
 */
class UserRepositoryFacade extends Facade
{

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'Larafa\UserProfile\UserRepository';
    }
}