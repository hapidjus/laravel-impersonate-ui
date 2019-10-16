# Laravel Impersonate UI

Laravel Impersonate UI is a Laravel Package that adds an easy to use UI for selecting users to impersonate when using https://github.com/404labfr/laravel-impersonate 

### Installation
Require laravel-impersonate with Composer
```
composer require lab404/laravel-impersonate
```

Require laravel-impersonate-ui with Composer
```
composer require hapidjus/laravel-impersonate-ui
```

Add the trait `Lab404\Impersonate\Models\Impersonate` to your __User__ model.

### Configuration

You can publish the config-file with:
```
php artisan vendor:publish --provider="Hapidjus\ImpersonateUI\ImpersonateUiServiceProvider"
```

This is the contents of the config file:
```
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
	* form submited - user impersonated. No need to click any
	* pesky buttons.
	* 
	*/
	'show_button' => true,

	/**
	* Globaly include laravel-impersonate-ui. 
	* 
	* Or use this view: @include('impersonate-ui::impersonate-ui')
	* 
	*/
	'global_include' => false,

	/**
	* The URI to redirect after taking an impersonation.
	*
	* Use 'back' to redirect to the previous page
	*
	*/
	'take_redirect_to' => 'back',

	/**
	* The URI to redirect after leaving an impersonation.
	*
	* Use 'back' to redirect to the previous page
	*
	*/
	'leave_redirect_to' => 'back',

];
```


Have fun impersonating.


Do not use in production!
