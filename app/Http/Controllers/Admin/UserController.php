<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Propaganistas\LaravelPhone\PhoneNumber;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Mail\UserCreatedMail;
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
            $roles=$roles->whereIn('name',['professeur']);
        }
        elseif(auth()->user()->hasRole('super-admin')){
            $roles=$roles->whereIn('name',['professeur','admin']);
        }
        $roles = $roles->get();
        return view('admin.user.create',compact('roles'));
    }

    public function store(Request $request)
{


        $messages = [
            'email.unique' => 'Cet email est déjà utilisé par un autre utilisateur.',
            'phone.phone' => 'Le numéro de téléphone doit être valide pour la Tunisie.',
        ];

        $request->validate([
            'name' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'phone' => 'required|phone:TN',
            'email' => 'required|email|unique:users,email',
            'roles' => 'required'
        ], $messages);


        $password = Str::random(8);
        $countryCode = '+216';
        $localNumber = $request->input('phone');
        $fullPhoneNumber = $countryCode . ' ' . $localNumber;
        //besh yarfou tunsi wila le 
        $formattedPhoneNumber = PhoneNumber::make($fullPhoneNumber, 'TN')->formatE164();


        $user = User::create([
            'name' => $request->name,
            'lastname' => $request->lastname,
            'phone' => $formattedPhoneNumber,
            'email' => $request->email,
            'password' => bcrypt($password),
            'status' => 'active',
            'first_login' => true,
        ]);


        $user->assignRole($request->roles);


        try {
            Mail::to($user->email)->send(new UserCreatedMail($user, $password));

        } catch (\Exception $e) {

            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de l\'envoi de l\'e-mail.',
            ], 500);
        }

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
