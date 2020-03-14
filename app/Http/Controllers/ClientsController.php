<?php

namespace App\Http\Controllers;

use App\Client;
use App\Invoice;
use Illuminate\Http\Request;
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
        $search = $request->get('search');
        $type = $request->get('type');
        $clients = Client::orderBy('id', 'DESC')
            ->search($search, $type)
            ->paginate(4);
        return view('client.index', compact('clients', 'search'));
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
    public function store(Request $request)
    {
        $this->authorize('create', new Client());
        $validData = $request->validate(
            [
                'name' => 'required|min:3|max:100',
                'last_name' => 'required|min:3|max:100',
                'id_type' => 'required',
                'id_card' => 'required|unique:clients|min:8|max:10',
                'email' => 'required|unique:clients|email',
                'cellphone' => 'required|min:10',
                'country' => 'required',
                'department' => 'required',
                'city' => 'required',
                'address' => 'required'
            ],
            [
                'required' => "El :attribute del Cliente es un campo obligatorio",
                'unique' => 'El :attribute ya está registrado',
                'min' => 'El :attribute de tener mínimo :min letras',
                'max' => 'El :attribute de tener máximo :max letras'
            ],
            [
                'name' => 'Nombre',
                'last_name' => 'Apellído',
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
        $client = new Client();
        $client->name = $validData['name'];
        $client->last_name = $validData['last_name'];
        $client->id_type = $validData['id_type'];
        $client->id_card = $validData['id_card'];
        $client->email = $validData['email'];
        $client->cellphone = intval($validData['cellphone']);
        $client->country = $validData['country'];
        $client->department = $validData['department'];
        $client->city = $validData['city'];
        $client->address = $validData['address'];
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
                'last_name' => 'required|min:3|max:100',
                'id_type' => 'required',
                'id_card' => [
                    'required',
                    Rule::unique('clients')->ignore($id),
                    'max:10',
                    'min:8'
                ],
                'email' => [
                    'required',
                    Rule::unique('clients')->ignore($id),
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
                'unique' => 'El :atribute ya está registrado',
                'min' => 'El :attribute de tener minimo :min letras'
            ],
            [
                'name' => 'Nombre',
                'last_name' => 'Apellído',
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
        $client->name = $validData['name'];
        $client->last_name = $validData['last_name'];
        $client->id_type = $validData['id_type'];
        $client->id_card = $validData['id_card'];
        $client->email = $validData['email'];
        $client->cellphone = intval($validData['cellphone']);
        $client->country = $validData['country'];
        $client->department = $validData['department'];
        $client->city = $validData['city'];
        $client->address = $validData['address'];
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
        $this->authorize('destroy', $client);
        $client->delete();
        return redirect()->route('clients.index');
    }

    public function confirmDelete($id)
    {
        $client = Client::findOrFail($id);
        $this->authorize('destroy', $client);
        return view('client.confirmDelete', [
            'client' => $client
        ]);
    }

    public function indexImport()
    {
        return view('client.importCLient');
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
