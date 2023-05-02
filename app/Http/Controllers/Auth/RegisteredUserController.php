<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Images;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Storage;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
    */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {

        $request->validate([
            'name' => ['required', 'string','min:3', 'max:255'],
            'role' => ['required', 'string', 'max:255'],
            'prenom' => ['required', 'string', 'min:3','max:255'],
            'adresse' => ['required', 'string', 'max:255'],
            'telephone' => ['required', 'integer','unique:'.User::class],
            'date_naissance' => ['required', 'date'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);


            $filename= time() . '.' . $request->photo->extension();
        
            $path=   $request->file('photo')->storeAs('photos',$filename,'public');
           // dd($path);
        


        $user = User::create([
            'name' => $request->name,
            'role' => $request->role,
            'prenom' => $request->prenom,
            'adresse' => $request->adresse,
            'telephone' => $request->telephone,
            'date_naissance' => $request->date_naissance,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $image= new Images();
        $image->path=$path;
        $user->image()->save($image);

        event(new Registered($user));

        Auth::login($user);

        return back()->with("success", "Utilisateur  ajouté avec succè!");

        return redirect(RouteServiceProvider::HOME);
    }


}
