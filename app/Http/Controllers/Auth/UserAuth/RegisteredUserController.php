<?php

namespace App\Http\Controllers\Auth\UserAuth;

use App\Http\Controllers\Controller;
use App\Models\UniversityCareer;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use App\Rules\InstitutionalEmailRule;
use App\Rules\ValidateAgeRule;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Inertia\Response;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): Response
    {
        $careers = UniversityCareer::all();
        return Inertia::render('Auth/UserAuth/Register', [
            'careers' => $careers,
        ]);
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'student_number' => 'required|lowercase|string|min:9|max:9|regex:/^[a-z][0-9]*$/|unique:'.User::class,
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class, new InstitutionalEmailRule],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'birthday' => ['required', 'date', new ValidateAgeRule],
            'university_career' => 'required|string|exists:'.UniversityCareer::class.',name',
        ], [], [
            'first_name' => 'nombre',
            'last_name' => 'apellido',
            'student_number' => 'número de control',
            'email' => 'correo electrónico',
            'password' => 'contraseña',
            'birthday' => 'fecha de nacimiento',
            'university_career' => 'carrera universitaria',
        ]);

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'birthday' => $request->birthday,
            'university_career' => $request->university_career,
            'student_number' => $request->student_number,
        ]);

        $user->assignRole('estudiante');

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
