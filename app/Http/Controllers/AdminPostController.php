<?php

namespace App\Http\Controllers;
use App\Models\Recipe;
use Illuminate\Http\Request;

class AdminPostController extends Controller
{
    public function index()
    { // Eager load the 'author' relationship
        return view('admin.posts.index', [
            'posts' => Recipe::with('author')->paginate(8)
        ]);
    }
    

    public function create()
    {
        return view('admin.posts.create'); //////////////////////////////////Create
    }

    public function store()
    {
        Recipe::create(array_merge($this->validatePost(), [
            'user_id' => request()->user()->id,
            'thumbnail' => request()->file('thumbnail')->store('thumbnails')
        ]));

        return redirect('/');
    }

    public function edit(Recipe $post)
    {
        return view('admin.posts.edit', ['post' => $post]); //////////////////////////////////Edit
    }

    public function update(Recipe $post)
    {
        $attributes = $this->validatePost($post);

        if ($attributes['thumbnail'] ?? false) {
            $attributes['thumbnail'] = request()->file('thumbnail')->store('thumbnails');
        }

        $post->update($attributes);

        return back()->with('success', 'Post Updated!');
    }

    public function destroy(Recipe $post)
    {
        $post->delete();

        return back()->with('success', 'Post Deleted!');
    }

    protected function validatePost(?Recipe $post = null): array
    {
        $post ??= new Recipe();

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
