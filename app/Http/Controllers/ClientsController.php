<?php

namespace App\Http\Controllers;

use App\User;
use App\Client;
use App\Invoice;
use Illuminate\Http\Request;
use App\Http\Requests\Clients\ClientStoreRequest;
use App\Exports\ClientExport;
use App\Imports\ClientImport;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Facades\Excel;

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
    public function index(Request $request)
    {
        $this->authorize('viewAny', new Client);
        $clients = Client::orderBy('id', 'DESC')->paginate(4);
        return view('client.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', new Client());
        return view('client.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClientStoreRequest $request, Client $client)
    {
        $this->authorize('create', $client);
        $user = new User();
        $user->name = $request->input('name');
        $user->lastname = $request->input('lastname');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('id_card'));
        $user->assignRole('client');
        $user->save();
        $client->id_type = $request->input('id_type');
        $client->id_card = $request->input('id_card');
        $client->cellphone = intval($request->input('cellphone'));
        $client->country = $request->input('country');
        $client->department = $request->input('department');
        $client->city = $request->input('city');
        $client->address = $request->input('address');
        $client->user_id = $user->id;
        $client->creator_id = auth()->user()->id;
        $client->save();
        return redirect()->route('clients.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        $this->authorize('show', $client);
        return view('client.show', [
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
        $this->authorize('update', $client);
        return view('client.edit', [
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

        $client = Client::findOrFail($id);
        $this->authorize('update', $client);
        $validData = $request->validate(
            [
                'name' => 'required|min:3|max:100',
                'lastname' => 'required|min:3|max:100',
                'id_type' => 'required',
                'id_card' => [
                    'required',
                    Rule::unique('clients')->ignore($id),
                    'max:10',
                    'min:8'
                ],
                'email' => [
                    'required',
                    Rule::unique('users')->ignore($client->user->id),
                    'email'
                ],
                'cellphone' => 'required|min:10|max:10',
                'country' => 'required',
                'department' => 'required',
                'city' => 'required',
                'address' => 'required'
            ],
            [
                'required' => "El :attribute del Cliente es requerido",
                'unique' => 'El :attribute ya está registrado',
                'min' => 'El :attribute de tener minimo :min letras'
            ],
            [
                'name' => 'Nombre',
                'lastname' => 'Apellído',
                'id_type' => 'Tipo de identificación',
                'id_card' => 'Número de identificación',
                'email' => 'Correo Electrónico',
                'cellphone' => 'Número de Celular',
                'country' => 'País',
                'department' => 'Departamento',
                'city' => 'Ciudad',
                'address' => 'Dirección'
            ]
        );
        //update user
        $client->user->name = $validData['name'];
        $client->user->lastname = $validData['lastname'];
        $client->user->email = $validData['email'];
        //update client
        $client->id_type = $validData['id_type'];
        $client->id_card = $validData['id_card'];
        $client->cellphone = intval($validData['cellphone']);
        $client->country = $validData['country'];
        $client->department = $validData['department'];
        $client->city = $validData['city'];
        $client->address = $validData['address'];
        $client->user_id = $client->user->id;
        $client->user->save();
        $client->save();
        return redirect()->route('clients.index');
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
        $this->authorize('delete', $client);
        $client->user->delete();
        $client->delete();
        return redirect()->route('clients.index');
    }

    public function confirmDelete($id)
    {
        $client = Client::findOrFail($id);
        $this->authorize('delete', $client);
        return view('client.confirmDelete', [
            'client' => $client
        ]);
    }

    public function indexImport()
    {
        $this->authorize('import', new Client);
        return view('client.importClient');
    }

    public function importExcel(Request $request)
    {
        $this->authorize('import', new Client);
        if ($request->file('file')) {
            $path = $request->file('file')->getRealPath();
            Excel::import(new ClientImport, $path);
            return redirect()->route('clients.index')->with('message', 'Importanción de facturas exítosa');
        } else {
            return back()->withErrors("ERROR, importación fallída");
        }
    }

    public function exportExcel()
    {
        $this->authorize('export', new Client);
        return Excel::download(new ClientExport, "client-list.xlsx");
    }
}
