<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdminPostController extends Controller
{
    public function index()
    {
        return view('admin.posts.index', [
            'posts' => Recipe::with('author')->paginate(8)
        ]);
    }

    public function create()
    {
        return view('admin.posts.create');
    }

    public function store(Request $request)
    {
        $validatedData = $this->validateRecipe($request);

        Recipe::create(array_merge($validatedData, [
            'user_id' => $request->user()->id,
            // 'thumbnail' => $request->file('thumbnail')->store('thumbnails')
        ]));

        return redirect('/admin/posts')->with('success', 'Recipe Published!');
    }

    public function edit(Recipe $post)
    {
        return view('admin.posts.edit', ['post' => $post]);
    }

    public function update(Request $request, Recipe $post)
    {
        $validatedData = $this->validateRecipe($request, $post);
    
        if ($request->hasFile('thumbnail')) {
            $validatedData['thumbnail'] = $request->file('thumbnail')->store('thumbnails');
        }
    
        $post->update($validatedData);
    
        return back()->with('success', 'Recipe Updated!');
    }

    public function destroy(Recipe $post)
    {
        $post->delete();

        return back()->with('success', 'Recipe Deleted!');
    }

    protected function validateRecipe(Request $request, ?Recipe $recipe = null): array
    {
        $recipe ??= new Recipe();

        return $request->validate([
            'RecipeName' => 'required|string|max:255',
            'Description' => 'required|string',
            'steps' => 'required|integer',
            'steps_details' => 'required|string',
            'NbIng' => 'required|integer|min:1',
            'ingredient_details' => 'required|string',
            'NbLikes' => 'nullable|integer|min:1',
            'UserIsApproved' => 'required|boolean',
            'Difficulty_level' => 'required|string|in:easy,medium,hard'
        ]);
    }
}
