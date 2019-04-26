<?php
Route::get('/', function () { return redirect('/admin/home'); });

// Authentication Routes...
$this->get('login', 'Auth\LoginController@showLoginForm')->name('auth.login');
$this->post('login', 'Auth\LoginController@login')->name('auth.login');
$this->post('logout', 'Auth\LoginController@logout')->name('auth.logout');

// Change Password Routes...
$this->get('change_password', 'Auth\ChangePasswordController@showChangePasswordForm')->name('auth.change_password');
$this->patch('change_password', 'Auth\ChangePasswordController@changePassword')->name('auth.change_password');

// Password Reset Routes...
$this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('auth.password.reset');
$this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('auth.password.reset');
$this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
$this->post('password/reset', 'Auth\ResetPasswordController@reset')->name('auth.password.reset');

Route::group(['middleware' => ['auth'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/home', 'HomeController@index')->name('home');
    
    Route::resource('roles', 'Admin\RolesController');
    Route::post('roles_mass_destroy', ['uses' => 'Admin\RolesController@massDestroy', 'as' => 'roles.mass_destroy']);
    Route::resource('users', 'Admin\UsersController');
    Route::post('users_mass_destroy', ['uses' => 'Admin\UsersController@massDestroy', 'as' => 'users.mass_destroy']);
    Route::resource('cleaning_statuses', 'Admin\CleaningStatusesController');
    Route::post('cleaning_statuses_mass_destroy', ['uses' => 'Admin\CleaningStatusesController@massDestroy', 'as' => 'cleaning_statuses.mass_destroy']);
    //Route::resource('clients', 'Admin\ClientsController');
    //Route::post('clients_mass_destroy', ['uses' => 'Admin\ClientsController@massDestroy', 'as' => 'clients.mass_destroy']);
    Route::resource('cleans', 'Admin\CleansController');
	Route::get('cleans/assign/{id}', 'Admin\CleansController@assign')->name('cleans.assign');
	Route::get('cleans/cancel/{id}', 'Admin\CleansController@cancel')->name('cleans.cancel');
	Route::get('cleans_load_config/{id}', 'Admin\CleansController@load_config')->name('cleans.load_config');
	Route::post('cleans_config', ['uses' => 'Admin\CleansController@config', 'as' => 'cleans.config']);
    Route::post('cleans_mass_destroy', ['uses' => 'Admin\CleansController@massDestroy', 'as' => 'cleans.mass_destroy']);
	Route::resource('clean_calendar', 'Admin\CleanCalendarController', ['only' => ['index']]);
	Route::post('clean_calendar_filter', ['uses' => 'Admin\CleanCalendarController@filter', 'as' => 'clean_calendar.filter']);
    Route::resource('cleaning_types', 'Admin\CleaningTypesController');
    Route::post('cleaning_types_mass_destroy', ['uses' => 'Admin\CleaningTypesController@massDestroy', 'as' => 'cleaning_types.mass_destroy']);
    Route::resource('address_types', 'Admin\AddressTypesController');
    Route::post('address_types_mass_destroy', ['uses' => 'Admin\AddressTypesController@massDestroy', 'as' => 'address_types.mass_destroy']);
    Route::resource('clean_categories', 'Admin\CleanCategoriesController');
    Route::post('clean_categories_mass_destroy', ['uses' => 'Admin\CleanCategoriesController@massDestroy', 'as' => 'clean_categories.mass_destroy']);
    Route::resource('cleans_mine', 'Admin\MinhasFaxinasController');
    Route::resource('cleans_open', 'Admin\FaxinasAbertasController');
    Route::resource('cleans_feedbacks', 'Admin\CleansFeedbacksController');
    Route::post('cleans_feedbacks_mass_destroy', ['uses' => 'Admin\CleansFeedbacksController@massDestroy', 'as' => 'cleans_feedbacks.mass_destroy']);
    Route::resource('subscription_statuses', 'Admin\SubscriptionStatusesController');
    Route::post('subscription_statuses_mass_destroy', ['uses' => 'Admin\SubscriptionStatusesController@massDestroy', 'as' => 'subscription_statuses.mass_destroy']);
    Route::resource('payment_statuses', 'Admin\PaymentStatusesController');
    Route::post('payment_statuses_mass_destroy', ['uses' => 'Admin\PaymentStatusesController@massDestroy', 'as' => 'payment_statuses.mass_destroy']);

    Route::model('messenger', 'App\MessengerTopic');
    Route::get('messenger/inbox', 'Admin\MessengerController@inbox')->name('messenger.inbox');
    Route::get('messenger/outbox', 'Admin\MessengerController@outbox')->name('messenger.outbox');
    Route::resource('messenger', 'Admin\MessengerController');


 
});
