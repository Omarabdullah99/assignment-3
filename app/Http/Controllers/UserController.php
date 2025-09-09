<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class UserController extends Controller
{

    use AuthorizesRequests;
    public function index()
    {
        $this->authorize('viewAny', User::class);
        return view('users.index', [
            'users' => User::get()
        ]);
    }

    public function edit(User $user)
    {
        $this->authorize('update', $user);
        return view('users.edit', [
            'user' => $user
        ]);
    }

    public function update(Request $request, User $user)
    {
        $this->authorize('update', $user);
        $data = $request->validate([
            'name' => 'required|string|max:30',
            'email' => 'required|email',
            'role' => 'required|string'
        ]);

        $user->update($data);
        return redirect()->route('users.index')->with('status', 'Updated');
    }

    public function destroy(User $user)
    {
        $this->authorize('delete', $user);
        $user->delete();
        return redirect()->route('users.index')->with('status', 'Deleted');
    }
}
