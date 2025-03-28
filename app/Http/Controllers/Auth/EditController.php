<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmailVerificationMail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Propaganistas\LaravelPhone\PhoneNumber;
class EditController extends Controller
{
    //page de parametre
    public function index()
    {
        $user = Auth::user();
        return view('admin.apps.profile.parametreCompte', compact('user'));
    }
    //page de modification de profile
    public function edit()
    {
        $user = Auth::user();
        return view('admin.apps.profile.edit', compact('user'));
    }
    public function update(Request $request)
    {
        $messages = [
            'phone.phone' => 'Le numéro de téléphone doit être valide pour la Tunisie.',
        ];

        $request->validate([
            'name' => 'string|max:255',
            'lastname' => 'string|max:255',
            'phone' => 'phone:TN',
        ], $messages);

        $user = Auth::user();
        $countryCode = '+216';
        $localNumber = $request->input('phone');
        $fullPhoneNumber = $countryCode . ' ' . $localNumber;

        $formattedPhoneNumber = PhoneNumber::make($fullPhoneNumber, 'TN')->formatE164();
        $user->name = $request->name;
        $user->lastname = $request->lastname;
        $user->phone = $formattedPhoneNumber;
        $user->save();

        return response()->json(['message' => 'Votre profil a été mis à jour avec succès.'], 200);
    }
    //page de modification de compte(email+password)
    public function updateCompte()
    {
        return view('admin.apps.profile.editCompte');
    }
    //pagee de modification de l'email
    public function updateEmail(){
        $user = Auth::user();
        return view('admin.apps.profile.editEmail', compact('user'));
    }
    //entrer le nouveau email et envoyer le code de verification
    public function sendEmailVerificationCode(Request $request)
    {
        \Log::info('Email reçu: ' );
        $messages = [
            'email.unique' => 'Cet email est déjà utilisé par un autre utilisateur.',
        ];
        $user = Auth::user();
        $request->validate([
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
        ], $messages);



        $verificationCode = Str::random(6);
        \Log::info('Code de vérification debut: ' . $verificationCode);



        session(['email_verification_code' => $verificationCode, 'new_email' => $request->email]);

        try {
            \Log::info('Code de vérification: ' . $verificationCode);
            Mail::to($request->email)->send(new EmailVerificationMail($user, $verificationCode));
        } catch (\Exception $e) {
            return response()->json(['error' => 'Une erreur est survenue lors de l\'envoi de l\'e-mail de validation.'], 422);
        }

        return response()->json(['message' => 'Un code de validation a été envoyé à votre nouvelle adresse email.'], 200);
    }



    //affichier la page de validation de code
    public function validateCode(){
        return view('admin.apps.profile.validateCode');
    }
    //entrer le code de verification et valider le nouveau email
    public function verifyAndUpdateEmail(Request $request)
    {
        $request->validate([
            'verification_code' => 'required',
        ]);

        if ($request->verification_code != session('email_verification_code')) {
            return response()->json(['error' => 'Le code de validation est incorrect.'], 422);
        }

        $user = Auth::user();
        $user->email = session('new_email');
        $user->save();

        session()->forget(['email_verification_code', 'new_email']);
        return response()->json(['message' => 'Votre email a été mis à jour avec succès.'], 200);
    }
    //affichier la page de modification de mot de passe
    public function editPassword()
    {
        return view('admin.apps.profile.editPassword');
    }

    //entrer l'ancien et le nouveau mot de passe et confirmer le nouveau mot de passe
    public function updatePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required|string',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = Auth::user();
        if (!Hash::check($request->old_password, $user->password)) {
            return response()->json(['error' => 'Le mot de passe actuel est incorrect.'], 422);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        return response()->json(['message' => 'Votre mot de passe a été mis à jour avec succès.'], 200);
    }

}
