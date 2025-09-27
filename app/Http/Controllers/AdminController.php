<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    // فقط للسوبر أدمن
    public function __construct()
    {
        $this->middleware(['auth', 'role:super_admin']);
    }

    // قائمة المسؤولين
    public function index()
    {
        $admins = User::role(['admin','super_admin'])->get();
        return view('admin.admins.index', compact('admins'));
    }

    // نموذج إضافة مسؤول
    public function create()
    {
        return view('admin.admins.create');
    }

    // حفظ مسؤول جديد
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required|in:admin,super_admin',
        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $user->assignRole($request->role);
        return redirect()->route('admins.index')->with('success','Admin added successfully');
    }

    // نموذج تعديل مسؤول
    public function edit(User $user)
    {
        return view('admin.admins.edit', compact('user'));
    }

    // تحديث بيانات المسؤول
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6|confirmed',
            'role' => 'required|in:admin,super_admin',
        ]);
        $user->name = $request->name;
        $user->email = $request->email;
        if($request->password){
            $user->password = Hash::make($request->password);
        }
        $user->save();
        $user->syncRoles([$request->role]);
        return redirect()->route('admins.index')->with('success','Admin updated successfully');
    }

    // حذف مسؤول
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admins.index')->with('success','Admin deleted successfully');
    }
}
