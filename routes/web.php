<?php

use App\Models\Recipes;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SessionController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('test3tem');
});

####################################Testing components################################################################3

Route::get('/s', function () {
    return view('\components\sidebar');
})->middleware('guest');
Route::get('/p', function () {
    return view('\components\profilepage');
});
Route::get('/l', function () {
    return view('\components\likebutton2');
});
####################################Testing components################################################################3

#################################### User ################################################################3
Route::get('/profile/{id}', [UserController::class, 'showProfile']);
Route::get('/Account/{id}', [UserController::class, 'fetchAccountById']);
Route::post('/profile/update/{id}', [UserController::class, 'updateProfile']);
Route::post('/account/delete', [UserController::class, 'deleteAccount']);
//Login view w button action//
Route::get('/Login', function () { 
    return view('Login');
});
Route::post('/Login', [UserController::class, 'login']);
Route::get('/logout', [UserController::class, 'clearSession']);
Route::post('/Register', [UserController::class, 'register']);
//create account //
Route::get('/reg', function () {
    return view('Registration');
});
#################################### User ################################################################3

#################################### Recipes ################################################################3
//Nav bar//
Route::get('/Recipes', [RecipeController::class, 'getRecipes']);
Route::get('/Recipe/{id}', [RecipeController::class, 'getRecipes']);

//Recipe card functions//
Route::get('/Step/{id}', [RecipeController::class, 'getStep']);
Route::get('/Ing/{id}', [RecipeController::class, 'getIng']);
Route::get('/Like/{id}', [RecipeController::class, 'IncLikes']);
Route::get('/Dislike/{id}', [RecipeController::class, 'DecLikes']);
#################################### Recipes ################################################################3

#################################### Home ################################################################3
Route::get('/Services', function () {
    return view('\Home\Services');
});
Route::get('/Contact', function () {
    return view('\Home\Contact');
});
Route::get('/Home', [RecipeController::class, 'gethomeNavRec']);
Route::get('/layout', [RecipeController::class, 'getNavRec']);
Route::get('/layoutt', [RecipeController::class, 'getNavRec2']);
#################################### Home ################################################################3


Route::middleware('guest')->group(function () {
   
    Route::get('/Login', function () {
        return view('Login');
    });
    Route::post('/Login', [UserController::class, 'login']);
});

// Group routes for authenticated users
Route::middleware('auth')->group(function () {

    Route::get('/Logout', [UserController::class, 'logout']);
});





// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
