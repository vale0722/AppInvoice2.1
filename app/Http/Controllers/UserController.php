<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
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
        $users = User::orderBy('id', 'DESC')->whereHas("roles", function ($query) {
            $query->where("name", "admin")->orWhere("name", "company")->orWhere("name", "treasurer");
        })->paginate(10);
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

    public function show(User $user)
    {
        $this->authorize('view', $user);
        return view('user.show', [
            'user' => $user
        ]);
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
