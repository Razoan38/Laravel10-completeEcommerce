<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\admin\ColorController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductsController as ProductFront;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/




Route::get('admin',[AuthController::class,'login'])->name('login');
Route::post('admin',[AuthController::class,'auth_login_admin'])->name('login.admin');
Route::get('admin/logout',[AuthController::class,'logout_admin'])->name('login.logout');

Route::group(['middleware' =>'admin'],function(){

    Route::get('admin/dashboard',[DashboardController::class,'dashboard'])->name('admin.dashboard');

    Route::get('admin/admin/list',[AdminController::class,'list'])->name('admin.admin.list');
    Route::get('admin/admin/add',[AdminController::class,'add'])->name('admin.add');
    Route::post('admin/admin/add',[AdminController::class,'insert']);
    Route::get('admin/admin/edit/{id}',[AdminController::class,'edit'])->name('admin.edit');
    Route::post('admin/admin/edit/{id}',[AdminController::class,'update'])->name('admin.update');
    Route::get('admin/admin/delate/{id}',[AdminController::class,'delate'])->name('admin.delate');

    // category
    Route::get('admin/category/list',[CategoryController::class,'list'])->name('admin.category.list');
    Route::get('admin/category/add',[CategoryController::class,'add'])->name('category.add');
    Route::post('admin/category/add',[CategoryController::class,'insert']);
    Route::get('admin/category/edit/{id}',[CategoryController::class,'edit'])->name('category.edit');
    Route::post('admin/category/edit/{id}',[CategoryController::class,'update'])->name('category.update');
    Route::get('admin/category/delate/{id}',[CategoryController::class,'delate'])->name('category.delate');

  //  subcategory
    Route::get('admin/sub_category/list',[SubCategoryController::class,'list'])->name('admin.sub_category.list');
    Route::get('admin/sub_category/add',[SubCategoryController::class,'add'])->name('admin.sub_category.add');
    Route::post('admin/sub_category/add',[SubCategoryController::class,'insert']);
    Route::get('admin/sub_category/edit/{id}',[SubCategoryController::class,'edit'])->name('admin.sub_category.edit');
    Route::post('admin/sub_category/edit/{id}',[SubCategoryController::class,'update'])->name('admin.sub_category.update');
    Route::get('admin/sub_category/delate/{id}',[SubCategoryController::class,'delate'])->name('admin.sub_category.delate');

    //ajax
    Route::post('admin/get_sub_category',[SubCategoryController::class,'get_sub_category']);

    //brand
    Route::get('admin/brand/list',[BrandController::class,'list'])->name('admin.brand.list');
    Route::get('admin/brand/add',[BrandController::class,'add'])->name('brand.add');
    Route::post('admin/brand/add',[BrandController::class,'insert']);
    Route::get('admin/brand/edit/{id}',[BrandController::class,'edit'])->name('brand.edit');
    Route::post('admin/brand/edit/{id}',[BrandController::class,'update'])->name('brand.update');
    Route::get('admin/brand/delate/{id}',[BrandController::class,'delate'])->name('brand.delate');

    //color
    Route::get('admin/color/list',[ColorController::class,'list'])->name('admin.color.list');
    Route::get('admin/color/add',[ColorController::class,'add'])->name('color.add');
    Route::post('admin/color/add',[ColorController::class,'insert']);
    Route::get('admin/color/edit/{id}',[ColorController::class,'edit'])->name('color.edit');
    Route::post('admin/color/edit/{id}',[ColorController::class,'update'])->name('color.update');
    Route::get('admin/color/delate/{id}',[ColorController::class,'delate'])->name('color.delate');

   // product
    Route::get('admin/product/list',[ProductController::class,'list'])->name('admin.product.list');
    Route::get('admin/product/add',[ProductController::class,'add'])->name('admin.product.add');
    Route::post('admin/product/add',[ProductController::class,'insert']);
    Route::get('admin/product/edit/{id}',[ProductController::class,'edit'])->name('admin.product.edit');
    Route::post('admin/product/edit/{id}',[ProductController::class,'update'])->name('admin.product.update');
    Route::get('admin/product/delate/{id}',[ProductController::class,'delate'])->name('admin.product.delate');

    Route::get('admin/product/image_delate/{id}',[ProductController::class,'image_delate'])->name('admin.product.image_delate');

    Route::post('admin/product_sortable_image',[ProductController::class,'product_sortable_image'])->name('admin.product_sortable_image');

    // Route::get('admin/dashboard', function () {
    //     return view('admin.dashboard');
    // });

    // Route::get('admin/admin/list', function () {
    //     $data['header_title'] = "Admin";
    //     return view('admin.admin.list',$data);
    // });

});



Route::get('/', function () {
    return view('welcome');
});

Route::get('/',[HomeController::class,'index'])->name('home');
Route::post('get_filter_product_ajax',[ProductFront::class,'getFilterProductAjax'])->name('get_filter_product_ajax');
Route::get('{category_slug?}/{subcategory_slug?}',[ProductFront::class,'getCategory'])->name('category_slug');


// 35 number video dakci error solution 
// 8 m pojunto dakci video 