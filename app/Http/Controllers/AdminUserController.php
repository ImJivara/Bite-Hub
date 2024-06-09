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
        return view('admin.posts.users.create');
    }

    public function store()
    {
        User::create(array_merge($this->validateUser(), [
            'password' => bcrypt(request('password'))
        ]));

        return redirect('/admin/users');
    }

    public function edit(User $user)
    {
        return view('admin.posts.users.edit', ['user' => $user]);
    }

    public function update(User $user)
    {
        $attributes = $this->validateUser($user);

        if ($attributes['password']) {
            $attributes['password'] = bcrypt($attributes['password']);
        } else {
            unset($attributes['password']);
        }

        $user->update($attributes);

        return back()->with('success', 'User Updated!');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return back()->with('success', 'User Deleted!');
    }

    protected function validateUser(?User $user = null): array
    {
        $user ??= new User();

        return request()->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user)],
            'location' => 'nullable|string|max:255',
            'password' => $user->exists ? ['nullable', 'string', 'min:8'] : ['required', 'string', 'min:8'],
            'UserIsAdmin' => 'required|boolean'
            
        ]);
    }
}
