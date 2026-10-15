<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;

class RoleController extends Controller
{
    //
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 1);
        $roles = Role::paginate($perPage);
        return response()->json($roles);
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'=>['string','max:100','unique:roles,name'],
            'description'=>['string','nullable'],
            'status'=>['required','boolean']
        ]);
        $role = Role::create($validated);
        return response()->json([
            'message'=>'Role created successfully',
            'data'=>$role
        ],201);
    }
    public function show($id)
    {
        $role = Role::findOrFail($id);

        return response()->json([
            'data' => $role
        ]);
    }
    public function update(Request $request, $id)
    {
        $role = Role::findOrFail($id);

        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:100',
                'unique:roles,name,' . $role->id,
            ],
            'description' => ['nullable', 'string'],
            'status' => ['required', 'boolean'],
        ]);

        $role->update($validated);

        return response()->json([
            'message' => 'Role updated successfully.',
            'data' => $role,
        ]);
    }
    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();
        return response()->json([
            'message' => 'Role deleted successfully.',
        ]);
    }
}
