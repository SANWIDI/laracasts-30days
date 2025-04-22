<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class RegisteredUserController extends Controller
{
    public function create()
    {
      return view('auth.register');
    }

    public function store()
    {
//     dd(request()->all());
//     how to save the form
//    validate
        $attributes = request()->validate([
            'first_name' => ['required'],
            'last_name'  => ['required'],
            'email'      => ['required', 'email'],
            'password'   => ['required', Password::min(6), 'confirmed']
        ]);
//    create the user to return the validate attributes/gives the data you put in the form.
        $user = User::create($attributes);
//    log in
        Auth::login($user);
//    Redirect
        return redirect('/jobs');

    }
}
