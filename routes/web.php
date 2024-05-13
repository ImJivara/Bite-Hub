<?php

use App\Models\Recipes;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\AccountController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('test3tem');
});

####################################Testing components################################################################3

Route::get('/s', function () {
    return view('\components\sidebar');
});
Route::get('/p', function () {
    return view('\components\profilepage');
});
Route::get('/l', function () {
    return view('\components\likebutton2');
});
####################################Testing components################################################################3

#################################### User ################################################################3
Route::get('/profile/{id}', [AccountController::class, 'showProfile']);
Route::get('/Account/{id}', [AccountController::class, 'fetchAccountById']);
Route::post('/profile/update/{id}', [AccountController::class, 'updateProfile']);
Route::post('/account/delete', [AccountController::class, 'deleteAccount']);
#################################### User ################################################################3

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

//Login view w button action//
Route::get('/Login', function () { 
    return view('Login');
});
Route::post('/Login', [AccountController::class, 'login']);
Route::get('/logout', [AccountController::class, 'clearSession']);




//create account //
Route::get('/reg', function () {
    return view('Registration');
});
Route::post('/Register', [AccountController::class, 'register']);

//Nav bar//
Route::get('/Recipes', [RecipeController::class, 'getRecipes']);
Route::get('/Recipe/{id}', [RecipeController::class, 'getRecipes']);

//Recipe card functions//
Route::get('/Step/{id}', [RecipeController::class, 'getStep']);
Route::get('/Ing/{id}', [RecipeController::class, 'getIng']);
Route::get('/Like/{id}', [RecipeController::class, 'IncLikes']);
Route::get('/Dislike/{id}', [RecipeController::class, 'DecLikes']);





// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
