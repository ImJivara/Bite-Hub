<?php

use App\Models\User;
use App\Models\Recipe;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ImageSearchEngine;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\WorkoutController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\AdminPostController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\NutritionController;
use App\Http\Controllers\FetchTestImageSearchEngine;

use App\Http\Controllers\Auth\RegisterController;


//  SPOONACULAR_API_KEY=a5e5afda0898426ab0bb39484bfdbde9 
// YOUR_EDAMAM_APP_ID=7ba1f1e8 
// YOUR_EDAMAM_APP_KEY=0bfaa9370bce866584f689af21404aa2
// WORKOUT_API_KEY=55715de52a098e66a462f228656ba1c7b0a7ac0c
// PEXELS_API_KEY=ThNtlJ7bMm7Mpkl4U8PsKwIgHEJqwgFEM8fM4WbF2zc28hVkb4Ob73HH  
// SERPAPI_KEY=5150a057a45311a21a42ed6b2a2a465e61e11021185585f6709ee477dea5ce56


Route::get('/image-search-form', function () {
    return view('ImageSearchForm');
});
Route::get('/image-search-SerpApi', [ImageSearchEngine::class, 'search'])->name('image.search');
Route::post('/save-image', [ImageSearchEngine::class, 'saveImage'])->name('save.image');


#################################### Testing components ################################################################3

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


// Route::post('/nutrition/fetch', [NutritionController::class, 'fetchNutritionalInfo']);
// Route::get('/nutrition/fetch', [NutritionController::class, 'fetchNutritionalInfo']);
// Route::post('/fetch-nutritional-info', [NutritionController::class, 'fetchNutritionalInfo'])->name('fetch.nutritional.info');
// Route::get('/profile/instagramreplica', [RecipeController::class, 'getRecipes']);
// Route::post('/recipes', [RecipeController::class, 'store'])->name('recipes.store');

#################################### Testing components ################################################################

#################################### Main Functions ################################################################
Route::get('/', function () {
    return view('\Home\home');
});
Route::get('/fetch', [FetchTestImageSearchEngine::class, 'fetchAndStoreRecipes2']);

#################################### Main Functions ################################################################

#################################### User ################################################################

//Authentication
Route::get('/Login', function () {return view('Login');});
    Route::post('/Login', [UserController::class, 'login']);
    Route::get('/Logout', [UserController::class, 'logout']);
    Route::post('/Register', [UserController::class, 'registerr']);

//Profile Events
Route::get('/profile/{id}', [UserController::class, 'GetProfileInfo'])->middleware("auth");
    Route::get('/profile/Edit Profile/{id}', function ($id) {
        $user = User::findOrFail($id);
        return view('Profile Folder.EditProfile', ["user" => $user]);
        })->middleware("auth");
    Route::get('/profile/recent-activities/{type?}', [ActivityController::class, 'recentActivities'])->name('recent-activities')->middleware("auth");
    Route::get('/change-password', [PasswordController::class, 'showChangePasswordForm']);
    Route::post('/change-password', [PasswordController::class, 'changePassword'])->name('password.change');
    Route::post('/profile/update/{id}', [UserController::class, 'updateProfile'])->middleware("auth");
    Route::post('/account/delete/{id}', [UserController::class, 'deleteAccount'])->middleware("auth");
    Route::post('/profile/upload-picture', [UserController::class, 'uploadPicture'])->name('profile.upload');
    Route::post('/profile/update-picture', [UserController::class, 'updatePicture'])->name('profile.update'); 

    //User to User Event
    Route::get('/follow/{user}', [UserController::class, 'toggleFollow'])->name('follow');
    Route::get('/unfollow/{user}', [UserController::class, 'toggleFollow'])->name('unfollow'); 

    Route::get('/Like/{RecipeId}', [RecipeController::class, 'like']);
    Route::get('/Dislike/{RecipeId}', [RecipeController::class, 'dislike']);
    Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');   
#################################### User ################################################################3
#################################### User Health Section ################################################################
//Health Section
Route::get('/HealthTools', function () {
    return view('Health Folder.Health2');
});

Route::post('/log-nutritional-data', [NutritionController::class, 'store'])->name('log-nutritional-data');
Route::get('/nutrition-logs/data', [NutritionController::class, 'fetchNutritionData'])->name('nutrition.data');;
Route::get('/user/monthly-nutritional-data', [NutritionController::class, 'fetchNutritionData']);

//Workout Planner
Route::get('/get-workouts', [WorkoutController::class, 'GetWorkouts'])->name('get-workouts');
    Route::get('/exercise/{id}', [WorkoutController::class, 'GetExercise']);

#################################### User Health Section ################################################################

#################################### Recipes ################################################################3
//Main page
Route::get('/Recipes', [RecipeController::class, 'getRecipes'])->name('recipes.sorted');
    Route::get('/categories', [RecipeController::class, 'getCategories']);

//Recipe card functions//
Route::get('/Recipe/{id}', [RecipeController::class, 'getRecipes']);
    Route::get('/Step/{id}', [RecipeController::class, 'getStep']);
    Route::get('/Ing/{id}', [RecipeController::class, 'getIng']);
    
    
//Recipe Form
Route::get('/recipes/create', [RecipeController::class,'getForm'])->name('recipes.Form');
Route::post('/recipes/create', [RecipeController::class,'store'])->name('recipes.create');
// Search 
Route::get('/recipes/search img', [RecipeController::class, 'searchrecipesbar'])->name('recipes.searchbar');
#################################### Recipes ################################################################3

#################################### Admin ################################################################3

Route::resource('admin/posts', AdminPostController::class);
Route::resource('admin/users',AdminUserController::class);

#################################### Admin ################################################################3
#################################### Home ################################################################3
Route::get('/Services', function () {
    return view('\Home\Services');
})->name('Services');
Route::get('/Contact', function () {
    return view('\Home\Contact');
})->name('Contact');


Route::get('/Image Search Engine', [ImageSearchEngine::class, 'index'])->name('image.index');
Route::get('/image search', [ImageSearchEngine::class, 'fetchAndSaveImages'])->name('recipes.search');


#################################### Home ################################################################3

Route::middleware('guest')->group(function () {
   
    
   
});

// Group routes for authenticated users
Route::middleware('auth')->group(function () {

    

});




Route::get('/retrieve/{RecipeId}', [RecipeController::class, 'RecipeLikedByWho']);//all users who liked the this recipe
Route::get('/retrieve2', [RecipeController::class, 'RecipesLikedByUser']); //by authenticated user
Route::get('/retrieve2/{RecipeId}', [RecipeController::class, 'RecipesLikedByUser']);//by specific user
Route::get('/retrieve3/{RecipeId}', [RecipeController::class, 'IsRecipeLikedByUser']);// check eza authenticated user has liked the post

Auth::routes();
