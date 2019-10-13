<?php
Route::group(['middleware' => ['web']], function () {
	Route::post('impersonate-ui', 'Hapidjus\ImpersonateUI\Controllers\ImpersonateUiController@take')->name('impersonate-ui.take');
	Route::get('impersonate-ui', 'Hapidjus\ImpersonateUI\Controllers\ImpersonateUiController@leave')->name('impersonate-ui.leave');
});

