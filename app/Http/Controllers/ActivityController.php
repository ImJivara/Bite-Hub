<?php

namespace App\Http\Controllers;


use App\Models\Activity;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ActivityController extends Controller
{
    
        public function recentActivities(Request $request)
        {   
            $query = Activity::query()->where('user_id',Auth::id());
            $type=$request->type;
            if ($type)
            {
                switch ($type) {
                    case 'like_recipe':
                        $query->where('type', 'like_recipe')->where('subject_type', 'App\Models\Recipe')->where('user_id',Auth::id());
                        break;
                    case 'like_comment':
                        $query->where('type', 'like_comment')->where('subject_type', 'App\Models\Comment')->where('user_id',Auth::id());
                        break;
                    case 'post_recipe':
                        $query->where('type', 'post_recipe')->where('subject_type', 'App\Models\Recipe')->where('user_id',Auth::id());
                        break;
                    case 'post_comment':
                        $query->where('type', 'post_comment')->where('subject_type', 'App\Models\Comment')->where('user_id',Auth::id());
                        break;
                    case 'All' :
                        $query->where('user_id', Auth::id());
                        break;
                    default:
                        break;
                }
            }
        
            $activities = $query->latest()->paginate(4);
        
            return view('Profile Folder.RecentActivities', ['activities' => $activities,'currentType' => $type]);
        }
    public function recentActivities2()
{
    // $likedComments = Activity::where('type', 'like_comment')->get();
    // $likedPosts = Activity::where('type', 'like_recipe')->get();

    // return view('Profile Folder.RecentActivities', compact('likedComments', 'likedPosts'));
    $activities = Activity::all();
    return view('Profile Folder.RecentActivities', compact('activities'));
}
}
