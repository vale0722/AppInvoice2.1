<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\RegistersUsers;

class UserController extends Controller
{
    use RegistersUsers;

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', new User());
        $users = User::orderBy('id', 'DESC')->paginate(10);
        return view('user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', new User());
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', new User());
        $data = $request->validate(
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
        $user = User::create([
            'name' => $data['name'],
            'lastname' => $data['lastname'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
        $user->assignRole($data['role']);
        return redirect()->route('users.index');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $this->authorize('delete', $user);
        $user->delete();
        return redirect()->route('users.index');
    }

    public function confirmDelete($id)
    {
        $user = User::findOrFail($id);
        $this->authorize('delete', $user);
        return view('user.confirmDelete', [
            'user' => $user
        ]);
    }
}
