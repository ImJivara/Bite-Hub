<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Recipe;
use App\Models\Activity;
// use Laravel\Prompts\alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Rules\UsernameValidationRule;
// use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller
{
    #################################### Authentication ################################################################
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        $user = User::where('email', $credentials['email'])->first();

        if ($user && Hash::check($credentials['password'], $user->password)) {
            Auth::login($user);
            return response()->json(['message' => 'Login successful', 'success' => true]);
        } else {
            return response()->json(['message' => 'Invalid credentials', 'success' => false]);
        }
    }

    public function registerr(Request $r)
    {
        try {
            if (User::where('email', $r->email)->first()) {
                return response()->json(['message' => 'Invalid email', 'success' => False]);
            }
            // Check if username is already taken
            if (User::where('username', $r->username)->exists()) {
                return response()->json(['message' => 'Username already taken', 'success' => false]);
            }

            $validator = Validator::make($r->all(), [
                'name' => 'required|string|max:255',
                'username' => ['required', 'string', 'max:20', 'unique:users'],
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:6',
            ]);
            if ($validator->fails()) {
                Log::error('Validation failed', ['errors' => $validator->errors()]);
                return response()->json([
                    'message' => 'Validation failed',
                    'errors' => $validator->errors(),
                    'success' => false
                ], 422);
            }
            $account = User::create([
                'name' => $r->name,
                'username' => $r->username,
                'email' => $r->email,
                'password' => bcrypt($r->password),
                'location' => "Lebanon",
                'IsAdmin' => False
            ]);

            return response()->json(['message' => 'Your Account Has Been Successfully Created', 'success' => True]);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage(), 'success' => False]);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/Recipes');
    }
    public function updateProfile(Request $request, $id)
    {

        try {
            $account = User::findOrFail($id);

            if (
                $account->name === $request->input('name') &&
                $account->email === $request->input('email') &&
                $account->username === $request->input('username') &&
                $account->location === $request->input('location')
            )
                return response()->json(['success' => false, 'message' => 'No changes detected']);
            else {
                $account->name = $request->input('name');
                $account->username = $request->input('username');
                $account->email = $request->input('email');
                $account->location = $request->input('location');
                $account->save(); //Update it
                return response()->json([
                    'success' => true,
                    'message' => 'Profile updated successfully',
                    'name' => $request->name,
                    'username' => $request->username,
                    'email' => $request->email,
                    'location' => $request->location,
                ]);
            }
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to update profile']);
        }
    }
    public function deleteAccount(Request $request)
    {

        $account = User::findOrFail($request->id); // Find the account by ID
        $account->delete(); // Delete the account
        return response()->json(['success' => true, 'message' => 'Account deleted successfully']);
    }
    #################################### Authentication ################################################################ 

    #################################### User Profile ################################################################
    public function GetProfileInfo(Request $request)
    {
        if ($request->id === Auth::user()->id) {
            // Fetch authenticated user's profile
            $user = Auth::user();
        } else {
            // Fetch other user's profile by ID
            $user = User::find($request->id);

            if (!$user) {
                abort(404);
            }
        }

        // Fetch posts based on the user
        $posts = Recipe::where('user_id', $user->id)
            ->latest()
            ->take(10)
            ->get();

        // Fetch liked recipes by the user
        $likedRecipes = $user->likedRecipes;

        // Fetch followers and following using relationships
        $followers = $user->followers;
        $following = $user->following;

        // Fetch recent activities for the user
        $recentActivities = Activity::where('user_id', $user->id)
            ->latest()
            ->take(10)
            ->get();

        // Determine which view to return based on whether it's the authenticated user's profile or another user's profile
        $view = $user->id === Auth::user()->id ? 'Profile Folder.ProfilePage' : 'Profile Folder.OtherProfilePage';

        return view($view, [
            'user' => $user,
            'posts' => $posts,
            'likedRecipes' => $likedRecipes,
            'followers' => $followers,
            'following' => $following,
            'recentActivities' => $recentActivities,
        ]);
    }
    public function uploadPicture(Request $request)
    {
        $request->validate([
            'profile_picture' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // max 2MB
        ]);

        $user = Auth::user();

        // Get the file from the request
        $file = $request->file('profile_picture');

        // Generate a unique file name
        $fileName = 'profile_' . $user->id . '.' . $file->getClientOriginalExtension();

        // Move the uploaded file to public directory
        $file->move(public_path('imgs/profile_pictures'), $fileName);

        // Update user's profile picture path in the database
        $user->profile_picture = 'imgs/profile_pictures/' . $fileName;
        $user->save();

        return response()->json(['message' => 'Profile picture uploaded successfully'], 200);
    }

    public function updatePicture(Request $request)
    {
        $request->validate([
            'profile_picture' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // max 2MB
        ]);

        $user = Auth::user();

        // Delete the old profile picture file if exists
        if (file_exists(public_path($user->profile_picture))) {
            unlink(public_path($user->profile_picture));
        }

        // Get the file from the request
        $file = $request->file('profile_picture');

        // Generate a unique file name
        $fileName = 'profile_' . $user->id . '.' . $file->getClientOriginalExtension();

        // Move the uploaded file to public directory
        $file->move(public_path('imgs/profile_pictures'), $fileName);

        // Update user's profile picture path in the database
        $user->profile_picture = 'imgs/profile_pictures/' . $fileName;
        $user->save();

        return response()->json(['message' => 'Profile picture updated successfully'], 200);
    }
    #################################### User Profile ################################################################

    // public function checkIfFollowing(Request $request, $userId)
    // {
    //     // Retrieve the authenticated user
    //     $user = $request->user();

    //     // Check if the user is following the specified user
    //     $isFollowing = $user->isFollowing($userId);

    //     // You might return a JSON response indicating whether the user is following the specified user
    //     return response()->json(['is_following' => $isFollowing]);
    // }

    #################################### User To User Events ################################################################
    /**
     * Toggle follow/unfollow a user.
     *
     * @param int $userId
     * @return \Illuminate\Http\Response
     */
    public function toggleFollow($userId)
    {
        $authUser = Auth::user();

        // Validate that the user is not trying to follow/unfollow themselves
        if ($authUser->id == $userId) {
            abort(400, 'You cannot follow or unfollow yourself.');
        }

        // Validate that the user to be followed/unfollowed exists
        $userToFollow = User::find($userId);
        if (!$userToFollow) {
            abort(404, 'User not found.');
        }

        // Check if the authenticated user is already following the user
        if ($authUser->isFollowing($userId)) {
            // Unfollow the user
            $authUser->unfollow($userId);
            $message = 'User unfollowed successfully.';
        } else {
            // Follow the user
            $authUser->follow($userId);
            $message = 'User followed successfully.';
        }

        // Optionally, you can redirect or render a view instead of returning JSON
        return redirect()->back()->with([
            'message' => $message,
            'followersCount' => $userToFollow->followers()->count(),
            'followingCount' => $authUser->following()->count(),
        ]);
    }

    /**
     * Check if the authenticated user is following another user.
     *
     * @param int $userId
     * @return \Illuminate\Http\Response
     */
    public function isFollowing($userId)
    {
        $authUser = auth()->user();

        // Validate that the user to check exists
        $userToCheck = User::find($userId);
        if (!$userToCheck) {
            return response()->json([
                'message' => 'User not found.',
            ], 404);
        }

        $isFollowing = Auth::isfollowing($userId);

        return response()->json([
            'is_following' => $isFollowing,
        ]);
    }

    /**
     * Get the count of users that the authenticated user is following.
     *
     * @return \Illuminate\Http\Response
     */
    public function followingCount()
    {
        $authUser = auth()->user();
        $count = Auth::followingcount();

        return response()->json([
            'following_count' => $count,
        ]);
    }

    /**
     * Get the count of followers for the authenticated user.
     *
     * @return \Illuminate\Http\Response
     */
    public function followersCount()
    {
        $authUser = auth()->user();
        $count = Auth::followerscount();

        return response()->json([
            'followers_count' => $count,
        ]);
    }

    public function getSuggestedUsers()
    {
        $authUser = Auth::user();
        $posts = Recipe::whereIn('user_id', $authUser->following()->pluck('followed_id'))->latest()->get();
        $authUserid= $authUser->id;
        // Get users who are not the authenticated user and not already followed
        $suggestedUsers = User::where('users.id', '!=', $authUser->id)
            ->whereNotIn('users.id', function ($query) use ($authUserid) {
                $query->select('follows.followed_id')
                    ->from('follows')
                    ->where('follows.follower_id', $authUserid);
            })->get();

         return view('foryoupage',[
             'suggestedUsers' => $suggestedUsers,
          'posts'=> $posts,

        ]);

        // return response()->json([
        //     'suggestedUsers' => $suggestedUsers,
        // ]);
    }
}
