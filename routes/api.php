<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
// Route::group(['middleware' => ['is_login']], function () {

Route::Post('login-request', 'Api\UserController@login');
Route::get('country', 'Api\HomeController@country');
Route::get('city', 'Api\HomeController@city');
Route::post('verification-code/check', 'Api\UserController@verification_code');
Route::get('home', 'Api\HomeController@home');
Route::get('privacy-policy', 'Api\PageController@privacy');
Route::get('term-and-condition', 'Api\PageController@terms');
Route::get('about-us', 'Api\PageController@abouts');
Route::get('FAQs','Api\PageController@faqs');
Route::get('how-it-work', 'Api\PageController@works');
Route::get('vendor-list', 'Api\HomeController@vendor_list');
Route::get('vendor-store-list', 'Api\HomeController@vendor_store_list');
Route::get('store/offers', 'Api\HomeController@vendor_offers');
Route::get('search', 'Api\OfferController@search');
Route::get('offers-map', 'Api\OfferController@offer_map');
Route::get('get_cridit', 'Api\HomeController@get_cridit');
Route::get('contact', 'Api\OfferController@contact');
Route::get('update_vendor_offer','Api\HomeController@update_vendor_offer');
Route::get('vendor', 'Api\HomeController@vendor_detels');
Route::get('popup-ad', 'Api\HomeController@popup_ad');
Route::get('store/branches', 'Api\HomeController@vendor_branches');
Route::post('verification-code/send','Api\UserController@resend_sms');
Route::get('package', 'Api\OfferController@package');
Route::get('my_fatoorah','Api\HomeController@my_fatoorah_credential');
Route::get('payment/myfatoorah/credentials','Api\OfferController@my_fatoorah_credential');
Route::post('credentials','Api\HomeController@credentials');
Route::post('apply-promo-code', 'Api\CodeController@apply_promo_code');

Route::group(['middleware' => 'auth:client_api'], function () {
    Route::group(['middleware' => 'devide'], function () {
        Route::get('client/info', 'Api\UserController@user_info');
        Route::post('store-favorite/create', 'Api\FavoritController@store_to_favorate');
        Route::delete('store-favorite/delete', 'Api\FavoritController@AddOrRemoveStoreFavorit');
        Route::post('package/payment/myfatoorah/request','Api\PayemntController@myfatoorah');

        Route::get('store-favorite', 'Api\FavoritController@store_favorite');
        Route::post('offer-favorite/create', 'Api\FavoritController@AddOrRemoveOfferFavorit');
        Route::delete('offer-favorite/delete', 'Api\FavoritController@OfferDeleteFovarit');
        Route::post('store-review/create','Api\HomeController@creacte_review');
        Route::get('store-review','Api\HomeController@review_sotre');
        
        Route::get('offer-favorite', 'Api\FavoritController@offer_favorite');
        Route::get('transactions','Api\UserController@transactions');
        Route::get('current-subscription','Api\UserController@current_subscription');
        // Route::get('vendor', 'Api\HomeController@vendor_detels');
        Route::get('store/reviews', 'Api\HomeController@vendor_reviews');
        Route::get('nearby-partners', 'Api\HomeController@nearby_partners');
        Route::get('offer', 'Api\OfferController@offerDetiles');
        Route::post('contact-us-support-message', 'Api\HomeController@post_support');
        Route::get('contact-us-support-message', 'Api\HomeController@get_support');
        Route::post('contact/create', 'Api\HomeController@contact_us');
        Route::get('profile', 'Api\HomeController@profile');
        Route::get('suggestion-offer', 'Api\OfferController@suggetstd_offer');
        Route::post('package/activation', 'Api\CodeController@sub_by_activiton');
        Route::post('redeem', 'Api\CodeController@redeem');
        Route::put('client/update/info', 'Api\UserController@update');
        Route::put('client/update/city', 'Api\UserController@update_city');
        Route::post('client/image/update', 'Api\UserController@update_image');
        Route::post('logout','Api\UserController@logout');
        Route::post('registration-id/refresh','Api\UserController@register_token');
    });
});

// });
Route::get('header_token', function () {
    $response['status'] = ['status' => false, 'HTTP_code' => 404, 'HTTP_response' => 'Unauthorized', 'message' => 'Unauthorized or Signed in from another device'];
    return $response;
})->name('header_token');
