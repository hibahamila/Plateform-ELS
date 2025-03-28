<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Mail\AccountValidationMail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Propaganistas\LaravelPhone\PhoneNumber;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */


    
    public function __construct()
    {
        $this->middleware('guest');
        //tkhalik kenk meksh conecte temshi lel page register w kenk connecte temshi lel page home 

    }


    public function showRegistrationForm()
    {
        return view('admin.authentication.sign-up');
    }

    public function register(Request $request)
    {
        $messages = [
            'email.unique' => 'Cet email est déjà utilisé par un autre utilisateur.',
            'phone.phone' => 'Le numéro de téléphone doit être valide pour la Tunisie.',
            'password.min' => 'La longueur du mot de passe doit être d\'au moins 8 caractères.',
        ];

        $request->validate([
            'name' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|phone:TN',
            'password' => 'required|string|min:8',
        ], $messages);

        $validationCode = Str::random(6);
        $countryCode = '+216';
        $localNumber = $request->input('phone');
        $fullPhoneNumber = $countryCode . ' ' . $localNumber;

        $formattedPhoneNumber = PhoneNumber::make($fullPhoneNumber, 'TN')->formatE164();

        $user = User::create([
            'name' => $request->name,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'phone' => $formattedPhoneNumber,
            'password' => Hash::make($request->password),
            'validation_code' => $validationCode,
            'status' => 'inactive',
            'first_login' => false,
        ]);
        
        // Stocker l'ID de l'utilisateur dans la session 
        $request->session()->put('user_id', $user->id);
        $user->assignRole('etudiant');

        try {
            Mail::to($user->email)->send(new AccountValidationMail($user, $validationCode));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Une erreur est survenue lors de l\'envoi de l\'e-mail de validation.');
        }

        return redirect()->route('validation.form')->with('success', 'Un code de validation a été envoyé à votre email.');
    }

    public function showValidationForm()
    {
        if (!session('user_id')) {
            return redirect()->route('login')->with('error', 'Session expirée. Veuillez vous connecter à nouveau.');
        }
        return view('auth.verify');
    }
    public function validateAccount(Request $request)
    {
        $request->validate([
            'validation_code' => 'required|string',
        ]);

        $userId = session('user_id');


        if (!$userId) {
            return redirect()->route('login')
                ->with('error', 'Votre session a expiré. Veuillez vous connecter à nouveau.');
        }

        $user = User::find($userId);

        if (!$user) {
            return redirect()->route('sign-up')
                ->with('error', 'Utilisateur non trouvé. Veuillez vous connecter à nouveau.');
        }

        if ($user->validation_code !== $request->validation_code) {
            return back()->with('error', 'Code de validation incorrect.');
        }


        $user->status = 'active';
        $user->validation_code = null;
        $user->email_verified_at = now();
        $user->save();

        // Supprimer l'ID de la session après validation

         session()->forget('user_id');


        auth()->login($user);

        return redirect()->route('home')
            ->with('success', 'Votre compte a été activé avec succès.');
    }
    public function resendCode(Request $request)
    {
        // Récupérer l'ID utilisateur de la session
        $userId = $request->session()->get('user_id');

        if (!$userId) {
            return redirect()->route('sign-up')
                ->with('error', 'Votre session a expiré. Veuillez vous inscrire à nouveau.');
        }

        $user = User::find($userId);

        if (!$user) {
            return redirect()->route('sign-up')
                ->with('error', 'Utilisateur non trouvé. Veuillez vous inscrire à nouveau.');
        }


        $validationCode = Str::random(6);
        $user->validation_code = $validationCode;
        $user->save();


        try {
            Mail::to($user->email)->send(new AccountValidationMail($user,$validationCode));
        } catch (\Exception $e) {
            \Log::error('Erreur d\'envoi d\'email: ' . $e->getMessage());
            return back()->with('warning', 'Problème lors de l\'envoi de l\'email. Votre nouveau code est: ' . $validationCode);
        }

        return back()->with('success', 'Un nouveau code de validation a été envoyé à votre email.');
    }

}

