<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\Rule;
use Stringable;

class UserController extends Controller
{
    //
    public function index()
    {
        $users = User::with('role')
                ->select('id','name','email','role_id','phone','status','created_at')
                ->paginate(10);
                
        return response()->json($users);
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
                'name'=>['required','max:255','string'],
                'email'=>['required','max:255','string','unique:users,email'],
                'password'=>['required','min:8','confirmed','string'],
                'role_id' => ['required', 'integer', 'exists:roles,id'],
                'phone' => ['nullable', 'string', 'max:20'],
                'status' => ['required', 'boolean'],
        ]);
        unset($validated['password_confirmation']);
        $user = User::create($validated);
        return response()->json([
            'message' => 'User created successfully.',
            'data' => $user->load('role'),
        ], 201);
    }
    public function show(string $id)
    {
        $user = User::with('role')
                ->select('name','email','phone','role_id','status')
                ->findOrFail($id);
        return response()->json(['data' => $user]);
    }
    public function update(Request $request, string $id) {
        $user = User::findOrFail($id);
        $validated = $request->validate([
            'name'=>['required','string','max:255'],
            'email'=>['required','string','max:255',
            Rule::unique('users','email')->ignore($user->id)],
            'password' => ['nullable', 'string', 'min:8'],
            'role_id' => ['required', 'integer', 'exists:roles,id'],
            'phone' => ['nullable', 'string', 'max:20'],
            'status' => ['required', 'boolean'],
        ]);
        // If no new password is provided, keep the existing one.
        if (empty($validated['password'])) {
            unset($validated['password']);
        }

        unset($validated['password_confirmation']);

        $user->update($validated);

        return response()->json([
            'message' => 'User updated successfully.',
            'data' => $user->load('role'),
        ]);
    }
    // Delete a user
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);

        $user->delete();

        return response()->json([
            'message' => 'User deleted successfully.',
        ]);
    }
}
