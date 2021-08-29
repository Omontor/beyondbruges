<?php

Route::get('partners', 'Api\V1\Admin\PartnerApiController@list');
Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:sanctum']], function () {
    // Permissions
    Route::apiResource('permissions', 'PermissionsApiController');

    // Roles
    Route::apiResource('roles', 'RolesApiController');

    // Users
    Route::apiResource('users', 'UsersApiController');

    // Partner
    Route::post('partners/media', 'PartnerApiController@storeMedia')->name('partners.storeMedia');
    Route::apiResource('partners', 'PartnerApiController');

    // Landmark
    Route::post('landmarks/media', 'LandmarkApiController@storeMedia')->name('landmarks.storeMedia');
    Route::apiResource('landmarks', 'LandmarkApiController');

    // Coupon
    Route::apiResource('coupons', 'CouponApiController');

    // Qr Code
    Route::apiResource('qr-codes', 'QrCodeApiController');

    // Blog
    Route::post('blogs/media', 'BlogApiController@storeMedia')->name('blogs.storeMedia');
    Route::apiResource('blogs', 'BlogApiController');

    // Itinerary
    Route::apiResource('itineraries', 'ItineraryApiController');

    // Prize
    Route::post('prizes/media', 'PrizeApiController@storeMedia')->name('prizes.storeMedia');
    Route::apiResource('prizes', 'PrizeApiController');

    // Redeem
    Route::apiResource('redeems', 'RedeemApiController');

    // Notification
    Route::apiResource('notifications', 'NotificationApiController');
});
