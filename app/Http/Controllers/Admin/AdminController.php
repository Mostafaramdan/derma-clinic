<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        $admins = User::role(['admin','super-admin'])->get();
        return view('admin.admins_index', compact('admins'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('admin.admins_create', compact('roles'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'roles' => 'required|array',
        ]);
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
        $user->assignRole($data['roles']);
        return redirect()->route('admin.admins.index')->with('success','Admin created successfully');
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        return view('admin.admins_edit', compact('user','roles'));
    }

    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'password' => 'nullable|string|min:6',
            'roles' => 'required|array',
        ]);
        $user->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'] ? Hash::make($data['password']) : $user->password,
        ]);
        $user->syncRoles($data['roles']);
        return redirect()->route('admin.admins.index')->with('success','Admin updated successfully');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.admins.index')->with('success','Admin deleted successfully');
    }
}
