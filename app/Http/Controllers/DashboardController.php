<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
<<<<<<< Updated upstream
    public function index(Request $request) {
=======
    public function index(Request $request)
    {
>>>>>>> Stashed changes
        return view('test', [
            'title' => $request->query('title')
        ]);
    }
}
