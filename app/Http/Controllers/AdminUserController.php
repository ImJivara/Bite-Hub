<?php


namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdminUserController extends Controller
{
    public function index()
    { 
        return view('admin.posts.users.index', [
            'users' => User::paginate(8)
        ]);
    }

    public function create()
    {
        return view('admin.posts.users.create'); //////////////////////////////////Create
    }
    public function edit(User $user)
    {
        return view('admin.posts.users.edit', ['user' => $user]); //////////////////////////////////Edit
    }
    public function update(User $user)
    {
        $attributes = $this->validatePost($user);

        if ($attributes['thumbnail'] ?? false) {
            $attributes['thumbnail'] = request()->file('thumbnail')->store('thumbnails');
        }

        $user->update($attributes);

        return back()->with('success', 'Post Updated!');
    }

    public function destroy(User $post)
    {
        $user->delete();

        return back()->with('success', 'Post Deleted!');
    }

    protected function validatePost(?User $post = null): array
    {
        $user ??= new User();

        return request()->validate([
            'title' => 'required',
            'thumbnail' => $post->exists ? ['image'] : ['required', 'image'],
            'slug' => ['required', Rule::unique('posts', 'slug')->ignore($post)],
            'excerpt' => 'required',
            'body' => 'required',
            'category_id' => ['required', Rule::exists('categories', 'id')]
        ]);
    }
}
