<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/', [App\Http\Controllers\Frontend\FrontendController::class, 'index']);
Route::get('categories', [App\Http\Controllers\Frontend\FrontendController::class, 'viewCategories']);
Route::get('category/{category_id}', [App\Http\Controllers\Frontend\FrontendController::class, 'viewCategoryPost']);
Route::get('category/{category_id}/{post_id}', [App\Http\Controllers\Frontend\FrontendController::class, 'viewPost']);
Route::get('search', [App\Http\Controllers\Frontend\FrontendController::class, 'searchUsers']);
Route::get('requests', [App\Http\Controllers\Frontend\FrontendController::class, 'friendRequests']);
Route::match(['get','post'],'followUser/{friend_id}', [App\Http\Controllers\Frontend\FrontendController::class, 'follow']);
Route::match(['get','post'],'unfollow/{friend_id}', [App\Http\Controllers\Frontend\FrontendController::class, 'unfollow']);


Route::get('profile', [App\Http\Controllers\Frontend\UserController::class, 'index']);
Route::post('profile', [App\Http\Controllers\Frontend\UserController::class, 'updateUserDetails']);
Route::get('profile/{user_id}', [App\Http\Controllers\Frontend\UserController::class, 'viewUserDetails']);


Route::post('comments', [App\Http\Controllers\Frontend\CommentController::class, 'store']);
Route::post('delete-comment', [App\Http\Controllers\Frontend\CommentController::class, 'delete']);

Route::match(['get','post'],'add-friend/{friend_id}', [App\Http\Controllers\Frontend\UserController::class, 'addFriend']);
Route::match(['get','post'],'accept-friend/{friend_id}', [App\Http\Controllers\Frontend\UserController::class, 'acceptFriend']);

Route::get('add-post', [App\Http\Controllers\Frontend\PostController::class, 'create']);
Route::post('add-post', [App\Http\Controllers\Frontend\PostController::class, 'store']);



Route::prefix('admin')->middleware(['auth', 'isAdmin'])->group(function () {

    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index']);

    Route::get('category', [App\Http\Controllers\Admin\CategoryController::class, 'index']);

    Route::get('add-category', [App\Http\Controllers\Admin\CategoryController::class, 'create']);
    Route::post('add-category', [App\Http\Controllers\Admin\CategoryController::class, 'save']);
    Route::get('edit-category/{category_id}', [App\Http\Controllers\Admin\CategoryController::class, 'edit']);
    Route::put('update-category/{category_id}', [App\Http\Controllers\Admin\CategoryController::class, 'update']);
    Route::get('delete-category/{category_id}', [App\Http\Controllers\Admin\CategoryController::class, 'destroy']);

    Route::get('posts', [App\Http\Controllers\Admin\PostController::class, 'index']);
    Route::get('add-post', [App\Http\Controllers\Admin\PostController::class, 'create']);
    Route::post('add-post', [App\Http\Controllers\Admin\PostController::class, 'store']);
    Route::get('posts/{post_id}', [App\Http\Controllers\Admin\PostController::class, 'edit']);
    Route::put('update-post/{post_id}', [App\Http\Controllers\Admin\PostController::class, 'update']);
    Route::get('delete-post/{post_id}', [App\Http\Controllers\Admin\PostController::class, 'delete']);

    Route::get('users', [App\Http\Controllers\Admin\UserController::class, 'index']);
    Route::get('users/{user_id}', [App\Http\Controllers\Admin\UserController::class, 'edit']);
    Route::put('update-user/{user_id}', [App\Http\Controllers\Admin\UserController::class, 'update']);

    Route::get('settings', [App\Http\Controllers\Admin\SettingsController::class, 'index']);
    Route::post('settings', [App\Http\Controllers\Admin\SettingsController::class, 'save']);
});