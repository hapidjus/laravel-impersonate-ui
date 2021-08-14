<?php

return [

	/**
	* Enable Laravel Impersonate UI
	* 
	* Laravel Impersonate UI is enabled by default when in debug 
	* 
	*/
	'enabled' => env('APP_DEBUG',false),

	/**
	* User Model Location.
	* 
	* default to : '\App\User'
	* you can specified other location like '\App\Models\User'
	* 
	*/
	'user_model' => '\App\User',

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
	* Note: If you include the view yourself you need to add
	* a check yourself to test if the current users is allowed 
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
