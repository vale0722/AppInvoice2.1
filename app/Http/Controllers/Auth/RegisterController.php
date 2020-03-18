<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Request;
use Illuminate\Foundation\Auth\RegistersUsers;

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
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make(
            $data,
            [
                'name' => ['required', 'string', 'max:255'],
                'lastname' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
                'role' => ['required'],
            ],
            [
                'required' => "El :attribute del usuario es un campo obligatorio",
                'unique' => 'El :attribute ya está registrado',
                'confirmed' => 'La confirmación de la :attribute no coincide',
                'min' => 'El :attribute de tener mínimo :min caracteres',
                'max' => 'El :attribute de tener máximo :max caracteres'
            ],
            [
                'name' => 'Nombre',
                'lastname' => 'Apellido',
                'email' => 'Correo Electrónico',
                'password' => 'Contraseña',
                'role' => 'role'
            ]
        );
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data, User $user)
    {
        $this->authorize('create', $user);
        $user = User::create([
            'name' => $data['name'],
            'lastname' => $data['lastname'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
        $user->assignRole($data['role']);
        return $user;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $this->authorize('update', $user);
        return view('user.edit', [
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $this->authorize('update', $user);
        $data = $request->validate(
            [
                'name' => ['required', 'string', 'max:255'],
                'lastname' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255',  Rule::unique('users')->ignore($user->id)],
            ],
            [
                'required' => "El :attribute del usuario es un campo obligatorio",
                'unique' => 'El :attribute ya está registrado',
                'min' => 'El :attribute de tener mínimo :min caracteres',
                'max' => 'El :attribute de tener máximo :max caracteres'
            ],
            [
                'name' => 'Nombre',
                'lastname' => 'Apellido',
                'email' => 'Correo Electrónico'
            ]
        );
        $user->name = $data['name'];
        $user->lastname = $data['lastname'];
        $user->email = $data['email'];
        $user->password = $user->password;
        if ($request->input('role') != NULL) {
            $user->removeRole($user->roles()->first());
            $user->assignRole($request->input('role'));
        }
        $user->update();
        return redirect()->route('users.show', [
            'user' => $user,
        ]);
    }
}
