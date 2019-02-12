# User Profile
This package is under development and it's not completed yet and it's going to be used in user profile management

## Getting Started

1. Add the "hasProfile" adn "hasFollowings" trait to the User model

```PHP
//User.php

use Larafa\UserProfile\hasProfile;
use Larafa\UserProfile\hasFollowings;

class User extends Authenticatable
{
    use Notifiable,
        hasProfile,
        hasFollowings;


    ...
}

```

2. Perform a fresh migrate
```
> php artisan migrate:fresh
```

3. You may also want to overwrite the model controllers and views so execute the following commands
```
> php artisan vendor:publish --tag=resources
> php artisan vendor:publish --tag=controllers
> php artisan vendor:publish --tag=user_views
> php artisan vendor:publish --tag=user_controller
```

3. In case you wanted to seed your database run the following command to have the user factory
```
> php artisan vendor:publish --tag=factories
```

Done.