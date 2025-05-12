<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Carbon\Carbon;
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
        try{

        
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
        }catch(\Exception $e){
           return response()->json([
            'message' => 'حدث خطأ أثناء التسجيل',
            'error' => $e->getMessage()
        ], 500);
        }
    }

    // GET /api/Utilisateur/getAll
    public function getAll()
    {
        return response()->json(Utilisateur::all());
    }

    // GET /api/Utilisateur/get/{id}
    public function get($id)
    {
        $user = Utilisateur::find($id);
        if (!$user) {
            return response()->json(['message' => 'لم يتم العثور على المستخدم'], 404);
        }
        return response()->json($user);
    }

    // DELETE /api/Utilisateur/delete/{id}
    public function delete($id)
    {
        $user = Utilisateur::find($id);
        if (!$user) {
            return response()->json('لم يتم العثور على المستخدم', 404);
        }
        $user->delete();
        return response()->json('تم حذف المستخدم بنجاح');
    }

    // DELETE /api/Utilisateur/deleteAll
    public function deleteAll()
    {
        Utilisateur::truncate();
        return response()->json('تم حذف جميع المستخدمين');
    }

    // PUT /api/Utilisateur/update-profile/{id}
    public function updateProfile($id, Request $request)
    {
        $user = Utilisateur::find($id);
        if (!$user) {
            return response()->json(['message' => 'لم يتم العثور على المستخدم'], 404);
        }

        $validated = $request->validate([
            'nom' => 'nullable|string|max:255',
            'email' => 'nullable|email|unique:utilisateurs,email,' . $id,
            'mdpsCompte' => 'nullable|string|min:6',
            'role' => 'nullable|integer',
        ]);

        if (isset($validated['mdpsCompte'])) {
            $validated['mdpsCompte'] = bcrypt($validated['mdpsCompte']);
        }

        $user->update($validated);
        return response()->json($user);
    }

    // POST /api/Utilisateur/setPersonnalite
    public function setPersonnalite(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:utilisateurs,id',
            'personnalite_id' => 'required|exists:personnalites,id',
        ]);

        $user = Utilisateur::find($validated['user_id']);
        $user->personnalite_id = $validated['personnalite_id'];
        $user->save();

        return response()->json($user);
    }

    // POST /api/Utilisateur/forgot-password
    public function forgotPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:utilisateurs,email'
        ]);

        $user = Utilisateur::where('email', $request->email)->first();

        $token = Str::random(64);
        $user->resetToken = $token;
        $user->tokenExpiry = Carbon::now()->addHour(); // expire dans 1h
        $user->save();

        // Envoyer l'email
        Mail::send('reset-password', [
            'user' => $user,
            'resetUrl' => "http://localhost:8081/reset-password?token={$token}&email={$user->email}"
        ], function ($message) use ($user) {
            $message->to($user->email)
                    ->subject('إعادة تعيين كلمة المرور الخاصة بك');
        });        

        return response()->json(['message' => 'Email envoyé !']);
    }

    // POST /api/Utilisateur/reset-password
    public function resetPassword(Request $request)
    {
        $request->validate([
            'password' => 'required|string|min:6',
            'confirmPassword' => 'required|string|same:password',
            'token' => 'required|string'
        ]);

        $user = Utilisateur::where('resetToken', $request->token)->first();

        if (!$user || Carbon::parse($user->tokenExpiry)->isPast()) {
            return response()->json(['message' => 'الرمز غير صالح أو منتهي الصلاحية.'], 400);
        }

        $user->mdpsCompte = Hash::make($request->password);
        $user->resetToken = null;
        $user->tokenExpiry = null;
        $user->save();

        return response()->json(['message' => '✅تم إعادة تعيين كلمة المرور.']);
    }
}
