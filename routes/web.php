<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['middleware' => 'auth'] , function() {

	Route::get('/home', 'HomeController@index')->name('home');

	Route::resource('/categories', 'CategoriesController');
	Route::resource('/tags','TagsController');
	Route::resource('/posts', 'PostsController');
	Route::get('/trashed', 'PostsController@trashed')->name('trashed.index');
	Route::get('/trashed/restore/{id}', 'PostsController@restore')->name('trashed.restore');

});

Route::middleware(['auth','admin'])->group(function() {
	Route::get('/users', 'UsersController@index')->name('users.index');
	Route::post('/users/{user}/make-admin', 'UsersController@makeAdmin')->name('users.make-admin');
    Route::post('/users/{user}/delete-user', 'UsersController@deleteUser')->name('users.delete-user');

});

Route::middleware(['auth'])->group(function() {

	Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

	Route::get('/users/{user}/profile', 'UsersController@edit')->name('users.edit');
	Route::post('/users/{user}/profile', 'UsersController@update')->name('users.update');

});

    Route::get('login/github', [LoginController::class,'redirectToProvider']);
    Route::get('login/github/callback', [LoginController::class,'handleProviderCallback']);
