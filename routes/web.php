<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\Auth\RegisterController;

Route::get('/', function () {
    return view('\Home\home');
});
// <a href="{{ route('contacts') }}">contacts</a>
#################################### Home ################################################################3
Route::get('/Services', function () {
    return view('\Home\Services');
})->name('Services');
Route::get('/Contact', function () {
    return view('\Home\Contact');
})->name('Contact');

#################################### Home ################################################################3

####################################Testing components################################################################3

Route::get('/s', function () {
    return view('\components\sidebar');
})->middleware('guest');
Route::get('/p', function () {
    return view('\components\piechart');
});
Route::get('/p1', function () {
    return view('\components\doughnutchart');
});
Route::get('/p2', function () {
    return view('\components\radialchart');
});
Route::get('/p3', function () {
    return view('\components\polarareachart');
});
Route::get('/p4', function () {
    return view('\components\gradientpiechart');
});
Route::get('/lay', function () {
    return view('\Profile Folder\ProfileLayout');
});
Route::get('/log', function () {
    return view('\components\extra components.LogReg');
});
Route::get('/app', function () {
    return view('\layouts\app');
});
Route::get('/form', function () {
    return view('PostForm');
});
Route::get('/logreg', function () {
    return view('login-registration form');
});
Route::post('/recipes', [RecipeController::class, 'store'])->name('recipes.store');
####################################Testing components################################################################3

#################################### User ################################################################3
Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');

Route::get('/profile/recent-activities/{type?}', [ActivityController::class, 'recentActivities'])->name('recent-activities')->middleware("auth");
Route::get('/profile/{id}', [RecipeController::class, 'GetProfileInfo'])->middleware("auth");

Route::get('/profile/Edit Profile/{id}', function ($id) {
    $user = User::findOrFail($id);
    return view('Profile Folder.EditProfile', ["user" => $user]);
})->middleware("auth");

Route::post('/profile/update/{id}', [UserController::class, 'updateProfile'])->middleware("auth");
Route::post('/account/delete/{id}', [UserController::class, 'deleteAccount'])->middleware("auth");
//Login view w button action//
Route::get('/Login', function () { 
    return view('Login');
});
Route::post('/Login', [UserController::class, 'login']);
Route::get('/logout', [UserController::class, 'clearSession']);
Route::post('/Register', [UserController::class, 'registerr']);
//create account //
Route::get('/Registration', function () {
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

#################################### Recipes ################################################################3


Route::middleware('guest')->group(function () {
   
    Route::get('/Login', function () {
        return view('Login');
    });
    Route::post('/Login', [UserController::class, 'login']);
});

// Group routes for authenticated users
Route::middleware('auth')->group(function () {

    Route::get('/Logout', [UserController::class, 'logout']);
    Route::get('/Like/{RecipeId}', [RecipeController::class, 'like']);
    Route::get('/Dislike/{RecipeId}', [RecipeController::class, 'dislike']);

});


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/retrieve/{RecipeId}', [RecipeController::class, 'RecipeLikedByWho']);//all users who liked the this recipe
Route::get('/retrieve2', [RecipeController::class, 'RecipesLikedByUser']); //by authenticated user
Route::get('/retrieve2/{RecipeId}', [RecipeController::class, 'RecipesLikedByUser']);//by specific user
Route::get('/retrieve3/{RecipeId}', [RecipeController::class, 'IsRecipeLikedByUser']);// check eza authenticated user has liked the post
// Account/{id}/LikesRecipe/{id}/Likes
Auth::routes();