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
	* Enable Laravel Impersonate UI
	* 
	* Laravel Impersonate UI is enabled by default when in debug 
	* 
	*/
	'enabled' => env('APP_DEBUG',false),

	/**
	* Users allowed to impersonate
	* 
	* Array of user emails, i.e ['admin@example.com'] or null for all
	* 
	*/
	'users_allowed_to_impersonate' => ['admin@example.com'],

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
	* Note: If you choose to include the partials view you need to add
	* a check to test if the current users is allowed 
	* to impersonate
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
	* Only allow these users to be impersonated
	*
	* Array of user IDs or null for all
	*
	*/
	'users_only' => null,

	/**
	* Exlude these users from beeing impersonated
	*
	* Array of user IDs or null for none
	*
	*/
	'users_exclude' => null,

];
```

### Partials view:

You can use the partials view to include the Impersonate UI on any pages you want.
Note: If you choose to include the partials view you need to add a check to test if the current users is allowed to impersonate

```php
@include('impersonate-ui::impersonate-ui')
```

Have fun impersonating.


Do not use in production!
