<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::group(['middleware' => ['guest']], function () {

    Route::get('/', function () {
        return view('auth.login');
    });

});

//==============================Translate all pages============================
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth'],
    ], function () {

        //==============================dashboard============================
        Route::get('/dashboard', 'HomeController@index')->name('dashboard');

        //==============================dashboard============================

        Route::prefix('admin')->group(function () {

            // //==============================Start Conatct Us============================
            // Route::namespace ('Admin')->prefix('contactUs')->group(function () {
            //     Route::get('/', 'ContactUsController@index')->name('contactUs.index');
            //     Route::post('/store', 'ContactUsController@store')->name('contactUs.store');
            //     Route::post('/update{id}', 'ContactUsController@update')->name('contactUs.update');
            //     Route::delete('/destroy{id}', 'ContactUsController@destroy')->name('contactUs.destroy');
            //     Route::get('/softDelete', 'ContactUsController@softDelete')->name('contactUs.softDelete');
            //     Route::post('/restore/{id}', 'ContactUsController@restore')->name('contactUs.restore');
            //     Route::post('/forceDelete/{id}', 'ContactUsController@forceDelete')->name('contactUs.forceDelete');

            // });
            // // //==============================End Conatct Us============================





            // //==============================ProductImgController============================
            // Route::group(['namespace' => 'Admin'], function () {
            //     Route::resource('product_img', 'ProductImgController');
            // });
            //==============================ProductImgController============================











            Route::group(['namespace' => 'Admin'], function () {
                Route::get('product_main_imgs', 'ProductImgController@product_main_imgs')->name('product_main_imgs');
                Route::post('productImg/store', 'ProductImgController@store')->name('productImg.store');
                Route::get('edit/product_main_imgs/{id}', 'ProductImgController@editproduct_main_imgs')->name('edit_product_main_imgs');
                Route::any('update/product_main_imgs/{id}', 'ProductImgController@updateproduct_main_imgs')->name('update_product_main_imgs');
                Route::delete('delete/product/{id}', 'ProductController@deleteAll')->name('deleteAll');

                Route::get('all/product/images/{id}', 'ProductImgController@allProductImg')->name('all_ProductImg');
                Route::get('deleteRow/product/{id}', 'ProductImgController@deleteRow')->name('deleteRow');

                Route::get('/createNewProImg/{id}', 'ProductImgController@createNewProImg')->name('createNewProImg');
                Route::post('/storeNewProImg2/{id}', 'ProductImgController@storeNewProImg2')->name('product_img.storeNewProImg2');

                Route::get('/softDeleteProImg','ProductImgController@softDelete')->name('proImg.softDelete');
                Route::post('/restore/{id}','ProductImgController@restore')->name('proImg.restore');
                Route::post('/forceDelete/{id}','ProductImgController@forceDelete')->name('proImg.forceDelete');

            });

            //==============================Start AboutUs Home============================
            Route::namespace ('Admin')->prefix('aboutUsHome')->group(function () {
                Route::get('/', 'AboutUsHomeController@index')->name('aboutUsHome.index');
                Route::post('/store', 'AboutUsHomeController@store')->name('aboutUsHome.store');
                Route::post('/update{id}', 'AboutUsHomeController@update')->name('aboutUsHome.update');
                Route::delete('/destroy{id}', 'AboutUsHomeController@destroy')->name('aboutUsHome.destroy');
                Route::get('/softDelete', 'AboutUsHomeController@softDelete')->name('aboutUsHome.softDelete');
                Route::post('/restore/{id}', 'AboutUsHomeController@restore')->name('aboutUsHome.restore');
                Route::post('/forceDelete/{id}', 'AboutUsHomeController@forceDelete')->name('aboutUsHome.forceDelete');
            });
            //==============================End  AboutUs Home============================

            //==============================Start About Us============================
            Route::namespace ('Admin')->prefix('aboutUs')->group(function () {
                Route::get('/', 'AboutUsController@index')->name('aboutUs.index');
                Route::post('/store', 'AboutUsController@store')->name('aboutUs.store');
                Route::post('/update{id}', 'AboutUsController@update')->name('aboutUs.update');
                Route::delete('/destroy{id}', 'AboutUsController@destroy')->name('aboutUs.destroy');
                Route::get('/softDelete', 'AboutUsController@softDelete')->name('aboutUs.softDelete');
                Route::post('/restore/{id}', 'AboutUsController@restore')->name('aboutUs.restore');
                Route::post('/forceDelete/{id}', 'AboutUsController@forceDelete')->name('aboutUs.forceDelete');

            });
            //==============================End About Us============================

            //==============================Start Conatct Us============================
            Route::namespace ('Admin')->prefix('contactUs')->group(function () {
                Route::get('/', 'ContactUsController@index')->name('contactUs.index');
                Route::post('/store', 'ContactUsController@store')->name('contactUs.store');
                Route::post('/update{id}', 'ContactUsController@update')->name('contactUs.update');
                Route::delete('/destroy{id}', 'ContactUsController@destroy')->name('contactUs.destroy');
                Route::get('/softDelete', 'ContactUsController@softDelete')->name('contactUs.softDelete');
                Route::post('/restore/{id}', 'ContactUsController@restore')->name('contactUs.restore');
                Route::post('/forceDelete/{id}', 'ContactUsController@forceDelete')->name('contactUs.forceDelete');

            });
           //==============================Start Categories Home============================
        Route::namespace('Admin')->prefix('Categories')->group(function()
        {
            Route::get('/','categoriesController@index')->name('Categories.index');
            Route::post('/store','categoriesController@store')->name('Categories.store');
            Route::any('/update{id}','categoriesController@update')->name('Categories.update');
            Route::delete('/destroy{id}','categoriesController@destroy')->name('Categories.destroy');
            Route::get('/softDelete','categoriesController@softDelete')->name('Categories.softDelete');
            Route::post('/restore/{id}','categoriesController@restore')->name('Categories.restore');
            Route::post('/forceDelete/{id}','categoriesController@forceDelete')->name('Categories.forceDelete');
        });
        //==============================End  Categories Home============================

        //==============================Start Products============================
        Route::namespace ('Admin')->prefix('products')->group(function () {
            Route::get('/', 'ProductController@index')->name('products.index');
            Route::get('/create', 'ProductController@create')->name('products.create');
            Route::get('/edit/{id}', 'ProductController@edit')->name('products.edit');
            Route::post('/store', 'ProductController@store')->name('products.store');
            Route::PATCH ('/update{id}', 'ProductController@update')->name('products.update');
            Route::delete('/destroy{id}', 'ProductController@destroy')->name('products.destroy');
            Route::get('/softDelete', 'ProductController@softDelete')->name('products.softDelete');
            Route::post('/restore/{id}', 'ProductController@restore')->name('products.restore');
            Route::post('/forceDelete/{id}', 'ProductController@forceDelete')->name('products.forceDelete');

        });
        //==============================End Products============================

        //==============================Start Admin============================
        Route::namespace ('Admin')->prefix('admin')->group(function () {
            Route::get('/', 'adminsController@index')->name('admin.index');
            Route::get('/edit/{id}', 'adminsController@edit')->name('admin.edit');
            Route::PATCH ('/update{id}', 'adminsController@update')->name('admin.update');
            Route::delete('/destroy{id}', 'adminsController@destroy')->name('admin.destroy');
            Route::get('/softDelete', 'adminsController@softDelete')->name('admin.softDelete');
            Route::post('/restore/{id}', 'adminsController@restore')->name('admin.restore');

            Route::get('/profile', 'adminsController@profile')->name('admin.profile');
            Route::post('/profile', 'adminsController@profileUpdate')->name('admin.profile.update');

            Route::get('/setting', 'adminsController@setting')->name('admin.setting');
            Route::post('/changePassword', 'adminsController@changePasswordUpdate')->name('admin.changePassword.update');

        });
        //==============================End Admin============================

            Route::prefix('slider')->group(function () {
                Route::get('/product', 'ProslidController@index')->name('pro_slider');
                Route::post('/prody/add/', 'ProslidController@store')->name('pro_slider_add');
                Route::any('/prody/update/{id}', 'ProslidController@update')->name('pro_slider_update');
                Route::any('/prody/delete/{id}', 'ProslidController@delete')->name('pro_slider_delete');

            });

        });

    });
