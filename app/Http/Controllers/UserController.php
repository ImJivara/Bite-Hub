<?php

namespace App\Http\Controllers;
use App\Models\User;
// use Laravel\Prompts\alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log ;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash ;
// use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller
{
   
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

    private function validateCredentials($email, $password)
    {
        $account = User::where('email', $email)->where('password', $password)->first();
        return $account !== null;
    }

    public function registerr(Request $r)
    { 
        try {
            if ($account = User::where('email', $r->email)->first()) 
            {
                return response()->json(['message' => 'Invalid email','success' => False]);
            }
            
            $validator = Validator::make($r->all(), [
                    'name' => 'required|string|max:255',
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
                'email' => $r->email,
                'password' =>bcrypt($r->password),
                'location' => "Lebanon",
                'IsAdmin'=>False
            ]);
            
             return response()->json(['message' => 'Your Account Has Been Successfully Created', 'success' => True]);
        } catch (\Exception $e) {
                                    return response()->json(['message' => $e->getMessage(), 'success' => False]);       
                                }
    }

    // public function clearSession()
    // {
    //     Session::flush();
    //     $recipes=Recipes::all();
    // //    return view('Recipes',['rec'=>$recipes]); // aw 3mel redirect aal /Recipes route directly
    // return redirect('Recipes');
    // }
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
        
            if ($account->name === $request->input('name') && 
                $account->email === $request->input('email') && 
                $account->location === $request->input('location')) 
                return response()->json(['success' => false, 'message' => 'No changes detected']);
           else{
            $account->name = $request->input('name');
            $account->email = $request->input('email');
            $account->location = $request->input('location');
            $account->save(); //Update it
            return response()->json([
                'success' => true,
                'message' => 'Profile updated successfully',
                'name' => $request->name,
                'email' => $request->email,
                'location' => $request->location,
            ]);
           } 
        } catch (\Exception $e) {return response()->json(['success' => false, 'message' => 'Failed to update profile']);}
    }
    public function deleteAccount(Request $request)
    {
 
        $account = User::findOrFail($request->id); // Find the account by ID
        $account->delete(); // Delete the account
        return response()->json(['success' => true, 'message' => 'Account deleted successfully']);
    }


    // public function followUser( $userIdToFollow)
    // {
    //     $user = Auth::user();

    //     if (!$user->$this->checkIfFollowing($userIdToFollow)) {
    //         $userToFollow=User::findOrFail($userIdToFollow);
    //         $user->following()->detach();
    //         $followersCount = User::findOrFail($userIdToFollow)->followersCount(); // Update followers count
    //     } else {
    //        $userIdToFollowCount= $user->$this->unfollowUser($userIdToFollow);
    //         // $followersCount = User::findOrFail($userIdToFollow)->followersCount(); // Update followers count
    //     }

    //     return response()->json(['followersCount' => $userIdToFollowCount]);
        
    // }

    // public function unfollowUser(Request $request, $userIdToUnfollow)
    // {
    //     // Retrieve the authenticated user
    //     $user = $request->user();

    //     // Check if the user to unfollow exists
    //     $userToUnfollow = User::findOrFail($userIdToUnfollow);

    //     // Unfollow the user
    //     $user->unfollow($userToUnfollow->id);

    //     $followingCount = $userIdToUnfollow->followingCount();
    //     return $followingCount;
    // }

    // public function checkIfFollowing(Request $request, $userId)
    // {
    //     // Retrieve the authenticated user
    //     $user = $request->user();

    //     // Check if the user is following the specified user
    //     $isFollowing = $user->isFollowing($userId);

    //     // You might return a JSON response indicating whether the user is following the specified user
    //     return response()->json(['is_following' => $isFollowing]);
    // }

    
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
            return response()->json([
                'message' => 'You cannot follow or unfollow yourself.',
            ], 400);
        }

        // Validate that the user to be followed/unfollowed exists
        $userToFollow = User::find($userId);
        if (!$userToFollow) {
            return response()->json([
                'message' => 'User not found.',
            ], 404);
        }

        // Check if the authenticated user is already following the user
        if (Auth::isfollowing($userId)) {
            // Unfollow the user
            Auth::unfollow($userId);
            $message = 'User unfollowed successfully.';
        } else {
            // Follow the user
            Auth::follow($userId);
            $message = 'User followed successfully.';
        }

        return response()->json([
            'message' => $message,
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
}
