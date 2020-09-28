<?php

use App\Category;
use App\Product;
use Illuminate\Support\Facades\Artisan;
// use Illuminate\Support\Str;
// use Spatie\MediaLibrary\MediaCollections\Models\Media;

// Media::cursor()->each(
//    fn (Media $media) => $media->update(['uuid' => Str::uuid()])
// );

/**
 * Site Routes
 */
Route::get('/', [
    'as'   => 'home',
    'uses' => 'SiteController@index',
]);

Route::get('about', [
    'as'   => 'about',
    'uses' => 'SiteController@about',
]);

Route::get('privacy', [
    'as'   => 'privacy',
    'uses' => 'SiteController@privacy',
]);

Route::get('terms', [
    'as'   => 'terms',
    'uses' => 'SiteController@termsConditions',
]);

Route::get('thanks', [
    'as'   => 'thanks',
    'uses' => 'SiteController@thanks',
]);

Route::get('contact', [
    'as'   => 'contact',
    'uses' => 'SiteController@contact',
]);

Route::get('specials', [
    'as'   => 'special',
    'uses' => 'SiteController@special',
]);

Route::post('contact', [
    'as'   => 'contact.post',
    'uses' => 'SiteController@contactPost',
]);

Route::get('category/{category}', [
    'as'   => 'category',
    'uses' => 'CategoryController@index',
]);

Route::get('category/{category}/{product}', [
    'as'   => 'product',
    'uses' => 'ProductController@show',
]);

Route::post('search', [
    'as'   => 'search',
    'uses' => 'SiteController@search',
]);

Route::resource('cart', 'CartController',  ['except' => ['create','edit', 'show','update']]);

Route::resource('checkout', 'CheckoutController',['except' => ['create','edit', 'update', 'show']]);

/**
 * Generic Model Binding
 */
Route::model('units', App\Unit::class);
Route::model('users', App\User::class);
Route::model('sliders', App\Slider::class);
Route::model('products', App\Product::class);
Route::model('specials', App\Special::class);
Route::model('categories', App\Category::class);
Route::model('unitrequests', App\UnitRequest::class);

/**
 * Frontend Model Binding
 */
Route::bind('category', function($value){
    return Category::whereSlug($value)->first();
});

Route::bind('subcategory', function($value){
    return Category::whereSlug($value)->first();
});

Route::bind('product', function($value){
    return Product::whereSlug($value)->first();
});

Route::name('admin.')->middleware(['auth'])->prefix('admin')->group(function() {

    Route::resource('users', 'Admin\UsersController');

    Route::get('specials/{specials}/image/{imageid}/delete', ['uses' => 'Admin\SpecialsController@deleteImage', 'as' => 'admin.specials.image.delete']);
    Route::resource('specials', 'Admin\SpecialsController');
    
    Route::get('sliders/removeimage/{sliders}/{imageid}', ['uses' => 'Admin\SlidersController@deleteImage', 'as' => 'admin.sliders.image.delete']);
    Route::resource('sliders', 'Admin\SlidersController');


    Route::resource('units', 'Admin\UnitController');

    Route::resource('unitrequests', 'Admin\RequestsController',  ['except' => ['create', 'edit', 'store', 'update']]);

    Route::get('categories/moveup/{categories}', ['uses' => 'Admin\CategoryController@moveUp', 'as' => 'admin.categories.moveup']);
    Route::get('categories/movedown/{categories}', ['uses' => 'Admin\CategoryController@moveDown', 'as' => 'admin.categories.movedown']);

    Route::get('categories/{categories}/images/{imageid}/delete', ['uses' => 'Admin\CategoryController@deleteImage', 'as' => 'admin.categories.image.delete']);

    Route::resource('categories', 'Admin\CategoryController');

    Route::get('products/{products}/image/{imageid}/default', ['uses' => 'Admin\ProductController@defaultImage', 'as' => 'admin.products.images.default']);

    Route::get('products/{products}/image/{imageid}/delete', ['uses' => 'Admin\ProductController@deleteImage', 'as' => 'admin.products.images.delete']);

    Route::get('products/{products}/image/{imageid}/accessories/delete', ['uses' => 'Admin\ProductController@deleteAccessoryImage', 'as' => 'admin.products.images.accessories.delete']);

    Route::post('products/{products}/images/add', ['uses' => 'Admin\ProductController@addImage', 'as' => 'admin.products.images.add']);
    Route::post('products/{products}/images/accessories/add', ['uses' => 'Admin\ProductController@addAccessoryImage', 'as' => 'admin.products.images.accessories.add']);

    Route::get('products/moveup/{products}', ['uses' => 'Admin\ProductController@moveUp', 'as' => 'admin.products.moveup']);
    Route::get('products/movedown/{products}', ['uses' => 'Admin\ProductController@moveDown', 'as' => 'admin.products.movedown']);
    Route::get('products/movetop/{products}', ['uses' => 'Admin\ProductController@moveToTop', 'as' => 'admin.products.movetop']);
    Route::get('products/movebottom/{products}', ['uses' => 'Admin\ProductController@moveToBottom', 'as' => 'admin.products.movebottom']);

    Route::resource('products', 'Admin\ProductController');

    Route::get('/', function () {
        return redirect()->route('admin.products.index');
    });

    Route::get('refreshmedia', function () {
        Artisan::call('medialibrary:regenerate');

        return redirect()->back();
    });

});

Auth::routes();
