![Licence: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)
# Laravel Impersonate UI

Laravel Impersonate UI is a Laravel Package that adds an easy to use UI for selecting users to impersonate when using https://github.com/404labfr/laravel-impersonate 

![Demo](https://raw.githubusercontent.com/hapidjus/laravel-impersonate-ui/master/screenshot.png)

### Requirements
- Laravel >= 6.1
- PHP >= 7.1


### Installation
- Require laravel-impersonate-ui with Composer
```php
composer require hapidjus/laravel-impersonate-ui
```

- Add the Trait `Lab404\Impersonate\Models\Impersonate` to your __User__ model.

```php
<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Lab404\Impersonate\Models\Impersonate;

class User extends Authenticatable
{
    use Notifiable,
        Impersonate;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}

```

### Configuration

To publish the config and blade files use:
```php
php artisan vendor:publish --provider="Hapidjus\ImpersonateUI\ImpersonateUiServiceProvider"
```

Append `--tag=config` or `--tag=view` to only publish config or blade files.


This is the contents of the config file:
```php
return [

	/**
	* Position of icon.
	* 
	* Supported: "bottom-right", "bottom-left", "top-left", "top-right"
	* 
	*/
	'icon_position' => 'bottom-right',

	/**
	* Show Impersonate button. 
	* 
	* Trying to save some clicks?
	* Then this is the option for you! Select a user and BOOM -  
	* form submitted - user impersonated. No need to click any
	* pesky buttons.
	* 
	*/
	'show_button' => true,

	/**
	* Globally include laravel-impersonate-ui. 
	* 
	* Or use this view: @include('impersonate-ui::impersonate-ui')
	* 
	*/
	'global_include' => true,

	/**
	* The URI/Route to redirect after taking an impersonation.
	*
	* Use 'back' to redirect to the previous page
	*
	*/
	'take_redirect_to' => 'back',

	/**
	* The URI/Route to redirect after leaving an impersonation.
	*
	* Use 'back' to redirect to the previous page
	*
	*/
	'leave_redirect_to' => 'back',

	/**
	* Only use these users
	*
	* Array of user IDs or null for all
	*
	*/
	'users_only' => null,

	/**
	* Exlude these users
	*
	* Array of user IDs or null
	*
	*/
	'users_exclude' => null,

];
```

### Partials view:

You can include impersonate view in the views by adding the code below to blade file where you want it will be displayed.

```php
@include('impersonate-ui::impersonate-ui')
```

Have fun impersonating.


Do not use in production!
