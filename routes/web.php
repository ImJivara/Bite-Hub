<?php

use App\Models\User;
use App\Models\Recipe;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\AdminPostController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\NutritionController;
use App\Http\Controllers\WorkoutController;
use App\Http\Controllers\Auth\RegisterController;



Route::get('/', function () {
    return view('\Home\home');
});
Route::get('/fetch', [RecipeController::class, 'fetchAndStoreRecipes2']);
// <a href="{{ route('contacts') }}">contacts</a>
#################################### Home ################################################################3
Route::get('/Services', function () {
    return view('\Home\Services');
})->name('Services');
Route::get('/Contact', function () {
    return view('\Home\Contact');
})->name('Contact');


Route::get('/recipesearch', [RecipeController::class, 'index'])->name('recipes.index');
Route::get('/recipes/search', [RecipeController::class, 'fetchAndSaveImages'])->name('recipes.search');


#################################### Home ################################################################3

####################################Testing components################################################################3

Route::get('/s', function () {
    return view('\components\sidebar');
})->middleware('guest');
Route::get('/p', function () {
    return view('\components\piecharts\piechart');
});
Route::get('/testpie', function () {
    return view('\components\piecharts\testpiechart');
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
Route::get('/profile/instagramreplica', function () {
    $user =Auth::user();
    $recipes=Recipe::all();
    return view('Profile Folder.instagramreplica', ["user" => $user ,"rec"=>$recipes]);
});
Route::get('/HealthTools', function () {
    return view('Health Folder.Health2');
});
Route::get('/nutritionsearch', function () {
    return view('nutritionfetch');
});

// Route::post('/nutrition/fetch', [NutritionController::class, 'fetchNutritionalInfo']);
// Route::get('/nutrition/fetch', [NutritionController::class, 'fetchNutritionalInfo']);
Route::post('/log-nutritional-data', [NutritionController::class, 'store'])->name('log-nutritional-data');
Route::get('/nutrition-logs/data', [NutritionController::class, 'fetchNutritionData'])->name('nutrition.data');;

Route::get('/get-workouts', [WorkoutController::class, 'GetWorkouts'])->name('get-workouts');
Route::get('/exercise/{id}', [WorkoutController::class, 'GetExercise']);


// Route::post('/fetch-nutritional-info', [NutritionController::class, 'fetchNutritionalInfo'])->name('fetch.nutritional.info');

// Route::get('/profile/instagramreplica', [RecipeController::class, 'getRecipes']);
// Route::post('/recipes', [RecipeController::class, 'store'])->name('recipes.store');
####################################Testing components################################################################3

#################################### User ################################################################3
Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');

Route::get('/profile/recent-activities/{type?}', [ActivityController::class, 'recentActivities'])->name('recent-activities')->middleware("auth");
Route::get('/profile/{id}', [RecipeController::class, 'GetProfileInfo'])->middleware("auth");
Route::get('/change-password', [PasswordController::class, 'showChangePasswordForm']);
Route::post('/change-password', [PasswordController::class, 'changePassword'])->name('password.change');
Route::get('/profile/Edit Profile/{id}', function ($id) {
    $user = User::findOrFail($id);
    return view('Profile Folder.EditProfile', ["user" => $user]);
})->middleware("auth");
// Route::get('/followers',function()
// {
//     return view('Profile Folder.followers');
// });
Route::get('/View Profile/User page',function(){
    $user=User::findorfail(2);
    $likedRecipes=Recipe::find(1);
    return view('Profile Folder.OtherProfilePage',compact('user','likedRecipes'));
});

Route::post('/follow/{user}', [UserController::class, 'followUser'])->name('follow');
Route::post('/unfollow/{user}', [UserController::class, 'unfollowUser'])->name('unfollow');

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
Route::resource('admin/posts', AdminPostController::class);
Route::resource('admin/users',AdminUserController::class);
// Account/{id}/LikesRecipe/{id}/Likes
Auth::routes();
