<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Utilisateur;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Validator;
class UtilisateurController extends Controller
{
    public function login(Request $request)
    {
        $user = Utilisateur::where('email', $request->email)->first();

        if (!$user) {
            return response()->json(['message' => 'بريد إلكتروني غير صحيح'], 401);
        }

        if (!Hash::check($request->password, $user->mdpsCompte)) {
            return response()->json(['message' => 'كلمة مرور غير صحيحة'], 401);
        }

        // Génération du token à 6 chiffres
        $token = strval(random_int(100000, 999999));
        $user->accessToken = $token;
        $user->save();

        return response()->json($user, 200);
    }

    public function register(Request $request)
    {
        // Utiliser validator au lieu de validate directement
        $validator = Validator::make($request->all(), [
            'nom' => 'required|string|max:255',
            'email' => 'required|email|unique:utilisateurs,email',
            'password' => 'required|min:6',
            'personnalite_id' => 'nullable|exists:personnalites,id',
        ], [
            // Messages d'erreur personnalisés
            'email.unique' => 'هذا البريد الإلكتروني مستخدم من قبل.',
            'password.min' => 'يجب أن تحتوي كلمة المرور على 6 أحرف على الأقل.',
        ]);

        // Si la validation échoue, retourner les erreurs
        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first() // ou collecter tous les messages
            ], 422);
        }


        
        $utilisateur = Utilisateur::create([
            'nom' => $request->nom,
            'email' => $request->email,
            'mdpsCompte' => Hash::make($request->password),
            'role' => $request->role ?? 0,
            'personnalite_id' => $request->personnalite_id ?? 1
        ]);

        $utilisateur->accessToken = strval(random_int(100000, 999999));
        $utilisateur->save();

        Mail::to($utilisateur->email)->send(new WelcomeMail($utilisateur->nom));
        

        return response()->json($utilisateur, 200);
    }
}
