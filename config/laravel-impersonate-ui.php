<?php

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
	* Globally include laravel-impersonate-ui. 
	* 
	* Or use this view: @include('impersonate-ui::impersonate-ui')
	* 
	*/
	'global_include' => false,

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

];