<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//Auth::routes();
//




Route::get('/', 'HomeController@index')->name('home');


Route::prefix('admin')->group(function(){

   Route::middleware('auth:admin')->group(function (){


       //Dashboard Route
       Route::get('/','DashboardController@index');

       /*
       |--------------------------------------------------------------------------
       | Products Routes
       |--------------------------------------------------------------------------
       */

        //Create Product Route

       Route::resource('/products','ProductController');

       /*
       |--------------------------------------------------------------------------
       | Order Routes
       |--------------------------------------------------------------------------
       */
       Route::resource('/orders','OrderController');

       Route::get('/confirm/{id}','OrderController@confirm')->name('order.confirm');
       Route::get('/pending/{id}','OrderController@pending')->name('order.pending');

       /*
       |--------------------------------------------------------------------------
       | User Routes
       |--------------------------------------------------------------------------
       */

       Route::resource('/users','UserController');


       //logout route

       Route::get('/logout','AdminUserController@logout');

    });

//Login routes

Route::get('/login','AdminUserController@index')->name('login');
Route::post('/login','AdminUserController@store');
});

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//front routes

Route::get('/home','Front\HomeController@index');

//user registration
Route::get('/user/register','Front\RegistrationController@index');
Route::post('/user/register','Front\RegistrationController@store');

//Route::get('/user/profile','Front\UserProfileController@index');

//User Login routes

Route::get('/user/login','Front\LoginController@index');

Route::post('/user/login','Front\LoginController@store');

//User Logout

Route::get('/user/logout','Front\LoginController@logout');

//User edit

Route::resource('/userProfile','Front\UserProfileController');

//Cart Routes
Route::resource('/cart','Front\CartController');

Route::post('/cart/saveLater/{product}','Front\CartController@saveLater')->name('cart.saveLater');

Route::get('empty',function (){

    Cart::instance('default')->destroy();

    return redirect()->back();

});
Route::patch('/cart/update/{product}','Front\CartController@update')->name('cart.update');

//Save for Later
Route::delete('/saveLater/destroy/{product}','Front\SaveLaterController@destroy')->name('saveLater.destroy');
Route::post('/cart/moveToCart/{product}','Front\SaveLaterController@moveToCart')->name('moveToCart');

//Checkout
Route::get('/checkout','Front\CheckoutController@index');
Route::post('/checkout','Front\CheckoutController@store');


//Language Change

Route::name('language')->get('language/{lang}', 'HomeController@language');











