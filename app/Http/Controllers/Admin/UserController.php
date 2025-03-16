<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;
class UserController extends Controller
{
    public function index()
    {

        $user = auth()->user();
        if ($user->hasRole('admin')) {
            $users = User::whereDoesntHave('roles', function ($query) {
                $query->whereIn('name', ['super-admin', 'admin']);
            })->get();
        } elseif ($user->hasRole('super-admin')) {
            $users = User::whereDoesntHave('roles', function ($query) {
                $query->where('name', 'super-admin');
            })->get();
        }

        return view('admin.user.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::query();
        if(auth()->user()->hasRole('admin')){
            $roles=$roles->whereNotIn('name',['super-admin','admin']);
        }
        elseif(auth()->user()->hasRole('super-admin')){
            $roles=$roles->whereNotIn('name',['super-admin']);
        }
        $roles = $roles->get();
        return view('admin.user.create',compact('roles'));
    }
    public function store(Request $request)
    {
        $messages = [
            'email.unique' => 'Cet email est déjà utilisé par un autre utilisateur.',
        ];

        $request->validate([
            'name' => 'required',
            'lastname' => 'required',
            'email' => 'required|email|unique:users,email',
            'roles' => 'required'
        ],$messages);
        $password = Str::random(8);
        $user = User::create([
            'name' => $request->name,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'password' => bcrypt($password),
            'status' => 'active',
        ]);
        $user->assignRole($request->roles);
        return response()->json([
            'success' => true,
            'message' => 'Utilisateur créé avec succès.',
            'password' => $password,
        ]);
    }



    public function destroy(User $user)
    {
        $user->delete();
        return response()->json(['success' => 'User a été supprimé avec succès']);
    }

    public function show(User $user)
    {

        return view('admin.user.roles', compact('user'));
    }

    public function removeRole(User $user, Role $role)
    {
        if ($user->hasRole($role)) {
            $user->removeRole($role);
            return response()->json(['message' => 'Role supprimé avec succès.','success' => true]);
        }
        return response()->json(['message' => "Ce rôle n'existe pas pour cet utilisateur.",'danger' => true]);
    }

    public function revokePermission(User $user, Permission $permission)
    {
        if ($user->hasPermissionTo($permission)) {
            $user->revokePermissionTo($permission);
            return response()->json(['message' => 'Permission supprimée avec succès.','success' => true]);
        }
        return response()->json(['message' => "Cette permission n'existe pas pour cet utilisateur.",'danger' => true], 404);
    }
    public function toggleStatus(User $user)
    {
        $user->status = $user->status === 'active' ? 'inactive' : 'active';
        $user->save();
        return response()->json([
            'message' => 'Statut modifié avec succès.',
            'success' => true,
            'status' => $user->status
        ]);
    }

}



