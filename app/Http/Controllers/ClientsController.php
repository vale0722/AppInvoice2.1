<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;

class ClientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('client.index', [
            'client' => client::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('client.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validData = $request->validate([
            'input_name' => 'required',
            'input_last_name' => 'required',
            'input_email' => 'required',
            'input_cellphone' => 'required|min:10',
            'input_country' => 'required',
            'input_city' => 'required',
            'input_address' => 'required'
        ]);
        $client = new Client();
        $client->name = $validData['input_name'];
        $client->last_name = $validData['input_last_name'];
        $client->email = $validData['input_email'];
        $client->cellphone = intval($validData['input_cellphone']);
        $client->country = $validData['input_country'];
        $client->city = $validData['input_city'];
        $client->address = $validData['input_address'];
        $client->save();
        return redirect('/clients');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $client = Client::findOrFail($id);
        return view('client.edit',[
            'client' => $client
        ]);
    }

 
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    { 
        $validData = $request->validate([
            'input_name' => 'required',
            'input_last_name' => 'required',
            'input_email' => 'required',
            'input_cellphone' => 'required|min:10',
            'input_country' => 'required',
            'input_city' => 'required',
            'input_address' => 'required'
        ]);
        $client = Client::findOrFail($id);
        $client->name = $validData['input_name'];
        $client->last_name = $validData['input_last_name'];
        $client->email = $validData['input_email'];
        $client->cellphone = intval($validData['input_cellphone']);
        $client->country = $validData['input_country'];
        $client->city = $validData['input_city'];
        $client->address = $validData['input_address'];
        $client->save();
        return redirect('/clients');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $client = Client::findOrFail($id);
        $client->delete();
        return redirect('/clients');
    }

    public function confirmDelete($id){
        $client = Client::findOrFail($id);
        return view('client.confirmDelete',[
            'client' => $client
        ]);
    }
}

