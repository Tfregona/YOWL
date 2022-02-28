<?php

use App\Http\Controllers\{
    Controller,
    UserController,
    RegisterController,
    LoginController,
    LogoutController,
    ForgotPwController,
    PostController,
    CategoryController,
    CommentController,
    SubCategoryController,
    AdminController,
    ResetController,
    NewsletterController
};
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

Route::get('/', [Controller::class, 'home'])->name('home.categories');
Route::get('/categories', [CategoryController::class, 'categories'])->name('categories');
Route::post('CreateCategories', [CategoryController::class, 'CreateCategories'])->name('post.category');
Route::post('AdminCreateUser', [AdminController::class, 'AdminCreateUser'])->name('AdminUser.create');


Route::post('/subcategories', [SubCategoryController::class, 'subcategorycreate'])->name('subcategory.create');
Route::get('/subcategories/{id}', [SubCategoryController::class, 'list'])->name('subcategories');

Route::get('/posts/{id}', [PostController::class, 'list'])->name('posts');
Route::get('/postshow/{id}', [CommentController::class, 'list'])->name('postshow');

// Route::resources([
//     'posts' => PostController::class,    
// ]);

// Route::resource('/posts', PostController::class)->except('index');
// Route::get('/post/create', [PostController::class, 'create'])->name('post.create');
// Route::post('/post/create', [PostController::class, 'store'])->name('post.store');
// Route::get('/post/{id}', [PostController::class, 'show'])->whereNumber('id')->name('post.show');


Route::get('register', [RegisterController::class, 'index'])->name('register');
Route::post('register', [RegisterController::class, 'register'])->name('post.register');

Route::get('login', [LoginController::class, 'index'])->name('login');
Route::post('login', [LoginController::class, 'login'])->name('post.login');

Route::get('logout', [LogoutController::class, 'logout'])->name('logout');

Route::get('reset/{token}', [ResetController::class, 'index'])->name('reset');
Route::post('reset', [ResetController::class, 'reset'])->name('post.reset');

Route::group(['middleware' => 'auth'], function () {
    Route::get('user/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
    Route::put('user/edit/{id}', [UserController::class, 'update'])->name('user.update');
    Route::post('user/store', [UserController::class, 'store'])->name('post.user');
    Route::delete('destroy/{user}', [UserController::class, 'destroy'])->name('user.destroy');

    Route::post('CreateComment/{id}', [CommentController::class, 'CreateComment'])->name('comment.create');
    Route::post('CreatePost/{id}', [PostController::class, 'CreatePost'])->name('posts.create');
});

// ADMIN ROUTES
Route::group(['middleware' => 'auth'], function () {
    Route::get('admin-page', [AdminController::class, 'index'])->name('admin.index');

    Route::delete('/category/delete/{id}', [AdminController::class, 'categorydestroy'])->name('category.destroy');
    Route::get('category/edit/{id}', [AdminController::class, 'categoryedit'])->name('category.edit');
    Route::put('category/edit/{id}', [AdminController::class, 'categoryupdate'])->name('category.update');

    Route::delete('/subcategory/delete/{id}', [AdminController::class, 'subcategorydestroy'])->name('subcategory.destroy');
    Route::get('subcategory/edit/{id}', [AdminController::class, 'subcategoryedit'])->name('subcategory.edit');
    Route::put('subcategory/edit/{id}', [AdminController::class, 'subcategoryupdate'])->name('subcategory.update');

    Route::delete('/post/delete/{id}', [AdminController::class, 'postdestroy'])->name('post.destroy');
    Route::get('post/edit/{id}', [AdminController::class, 'postedit'])->name('post.edit');
    Route::put('post/edit/{id}', [AdminController::class, 'postupdate'])->name('post.update');

    Route::delete('/comment/delete/{id}', [AdminController::class, 'commentdestroy'])->name('comment.destroy');
    Route::get('comment/edit/{id}', [AdminController::class, 'commentedit'])->name('comment.edit');
    Route::put('comment/edit/{id}', [AdminController::class, 'commentupdate'])->name('comment.update');

    Route::delete('/AdminUser/delete/{id}', [AdminController::class, 'AdminUserdestroy'])->name('AdminUser.destroy');
    Route::get('AdminUser/edit/{id}', [AdminController::class, 'AdminUseredit'])->name('AdminUser.edit');
    Route::put('AdminUser/edit/{id}', [AdminController::class, 'AdminUserupdate'])->name('AdminUser.update');
});
// END ADMIN ROUTES

// PROFILE ROUTES
Route::group(['middleware' => 'auth'], function () {
    Route::get('/profile', [UserController::class, 'profile'])->name('user.profile');
    Route::get('landing', [Controller::class, 'landing'])->name('post.landing');
    Route::get('landing/form/{id}', [Controller::class, 'postForm'])->name('post.form');
    Route::post('landing/form', [Controller::class, 'postCreate'])->name('post.create.form');
});
// END PROFILE ROUTES

//ROUTES DE UPDATE ET RESET PASSWORDS
Route::get('forgotpw', [ForgotPwController::class, 'index'])->name('forgotpw');
Route::post('forgotpw', [ForgotPwController::class, 'store'])->name('post.forgotpw');

Route::get('user/password',[UserController::class, 'password'])->name('user.password');
Route::post('password',[UserController::class, 'updatePassword'])->name('update.password');

//ROUTE MENTIONS LEGALES
Route::get('legalnotices', function () {
    return view('legal.MLegales');
})->name('mentionslegales');

Route::get('newsletter', [NewsletterController::class, 'index'])->name('newsletter');
Route::post('newsletter', [NewsletterController::class, 'newsletter'])->name('post.newsletter');