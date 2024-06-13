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
    // public function login(Request $request)
    // {
    //     $email = $request->input('email');
    //     $password = $request->input('password');

    //     // Call a custome function to validate credentials
    //     if ($this->validateCredentials($email, $password)) 
    //     {
    //      $account = User::where('email', $email)->first();
    //      session(['user' => $account]);
    //      Auth::login($account);
    //      return response()->json(['success' => true]);
            
    //     } else {
    //         // Authentication failed
    //         // abort(404);
    //         return  response()->json(['message' => 'Invalid email or password']);
    //     }
    // }
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
   

// public function register(Request $r)
// {
    // Validate the incoming request data
    // $validator = Validator::make($r->all(), [
    //     'name' => 'required|string|max:255',
    //     'email' => 'required|string|email|max:255|unique:user',
    //     'password' => 'required|string|min:3|confirmed',
    // ]);

    // Check if validation fails
    // if ($validator->fails()) {
    //     return response()->json(['message' => $validator->errors()], 422);
    // }
    // try {
    //     // Create the user account
    //     $account = User::create([
    //         'name' => $r->name,
    //         'email' => $r->email,
    //         'password' => $r->password,
    //         'location' => "Lebanon",
    //     ]);
        
    //     return response()->json(['message' => 'Your Account Has Been Successfully Created', 'success' => true]);
    // } catch (\Exception $e) {
    //     return response()->json(['message' => 'An error occurred while processing your request'], 500);
    // }
// }

    


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


    public function followUser(Request $request, $userIdToFollow)
    {
        // Retrieve the authenticated user
        $user = $request->user();

        // Check if the user to follow exists
        $userToFollow = User::findOrFail($userIdToFollow);

        // Follow the user
        $user->follow($userToFollow->id);

        // You might return a success response here
    }

    public function unfollowUser(Request $request, $userIdToUnfollow)
    {
        // Retrieve the authenticated user
        $user = $request->user();

        // Check if the user to unfollow exists
        $userToUnfollow = User::findOrFail($userIdToUnfollow);

        // Unfollow the user
        $user->unfollow($userToUnfollow->id);

        // You might return a success response here
    }

    public function checkIfFollowing(Request $request, $userId)
    {
        // Retrieve the authenticated user
        $user = $request->user();

        // Check if the user is following the specified user
        $isFollowing = $user->isFollowing($userId);

        // You might return a JSON response indicating whether the user is following the specified user
        return response()->json(['is_following' => $isFollowing]);
    }

    


}
