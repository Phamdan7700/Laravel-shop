
<?php
/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register admin routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "admin" middleware group. Now create something great!
|
*/

use App\Http\Controllers\Admin\AjaxController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SliderController;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



Route::prefix('admin')->group(function () {
    Route::middleware('guest:admin')->group(function () {
        Route::get('/login',        [AuthController::class, 'getLogin'])->name('admin.getLogin');
        Route::post('/login',        [AuthController::class, 'login'])->name('admin.login');
    });

    Route::middleware(['auth:admin'])->name('admin.')->group(function () {
        Route::get('/',     [DashboardController::class, 'index'])->name('index');
        /* Category */
        Route::resource('/category', CategoryController::class);
        Route::post('ajax/category/change-status/{id}', [AjaxController::class, 'changeCategoryStatus'])->name('category.changeStatus');

        /* Product */
        Route::resource('/product', ProductController::class);
        Route::post('ajax/product/change-status/{id}', [AjaxController::class, 'changeProductStatus'])->name('product.changeStatus');

        /* Blog */
        Route::resource('/blog', BlogController::class);
        Route::post('ajax/blog/change-status/{id}', [AjaxController::class, 'changePostStatus'])->name('blog.changeStatus');

        /* Slider */
        Route::resource('/slider', SliderController::class);
        Route::post('ajax/slider/change-status/{id}', [AjaxController::class, 'changeSliderStatus'])->name('slider.changeStatus');

        /* Order */
        Route::resource('/order', OrderController::class);
        Route::post('ajax/order/change-status/{id}', [AjaxController::class, 'changeOrderStatus'])->name('order.changeStatus');


        Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

        Route::get('/file-manager', [DashboardController::class, 'filemanager'])->name('filemanager');
    });
});
