<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{Client, Invoice, Company};

class ClientsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
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
            'name' => 'required',
            'last_name' => 'required',
            'id_type' => 'required',
            'id_card' =>'required|unique:clients',
            'email' => 'required|unique:clients',
            'cellphone' => 'required|min:10',
            'country' => 'required',
            'city' => 'required',
            'address' => 'required'
        ]);
        $client = new Client();
        $client->name = $validData['name'];
        $client->last_name = $validData['last_name'];
        $client->id_type = $validData['id_type'];
        $client->id_card = $validData['id_card'];
        $client->email = $validData['email'];
        $client->cellphone = intval($validData['cellphone']);
        $client->country = $validData['country'];
        $client->city = $validData['city'];
        $client->address = $validData['address'];
        $client->save();
        return redirect('/clients');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        return view('client.show',[
            'invoice' => Invoice::all(),
            'client' => $client
        ]);
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
            'name' => 'required',
            'last_name' => 'required',
            'id_type' => 'required',
            'id_card' =>'required',
            'email' => 'required',
            'cellphone' => 'required|min:10',
            'country' => 'required',
            'city' => 'required',
            'address' => 'required'
        ]);
        $client = Client::findOrFail($id);
        $client->name = $validData['name'];
        $client->last_name = $validData['last_name'];
        $client->id_type = $validData['id_type'];
        $client->id_card = $validData['id_card'];
        $client->email = $validData['email'];
        $client->cellphone = intval($validData['cellphone']);
        $client->country = $validData['country'];
        $client->city = $validData['city'];
        $client->address = $validData['address'];
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

?>