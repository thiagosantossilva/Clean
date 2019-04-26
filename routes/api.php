<?php

Route::group(['prefix' => '/v1', 'namespace' => 'Api\V1', 'as' => 'api.'], function () {

		Route::post('insert_clean', ['uses' => 'WordpressController@insert_clean', 'as' => 'wordpress.insert']);
        //Route::resource('cleans', 'CleansController', ['except' => ['create', 'edit']]);

        //Route::resource('subscription_statuses', 'SubscriptionStatusesController', ['except' => ['create', 'edit']]);

});
