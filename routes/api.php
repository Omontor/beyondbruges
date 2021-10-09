<?php

use Illuminate\Http\Request;

Route::post('register', [\App\Http\Controllers\PassportAuthController::class, 'store']);
Route::post('login', [\App\Http\Controllers\PassportAuthController::class, 'login']);
Route::get('partners', 'Api\V1\Admin\PartnerApiController@list');
Route::get('landmarks', 'Api\V1\Admin\LandmarkApiController@list');
Route::post('usercoupons', [\App\Http\Controllers\PassportAuthController::class, 'usercoupons']);
Route::get('coupons', [\App\Http\Controllers\PassportAuthController::class, 'list']);

Route::middleware('auth:api')->post('purchase', [\App\Http\Controllers\PassportAuthController::class, 'makepurchase']);

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('udid', [\App\Http\Controllers\PassportAuthController::class, 'udid']);

Route::middleware('auth:api')->group(function () {
    Route::resource('posts', PostController::class);
});

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
