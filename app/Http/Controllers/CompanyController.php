<?php

namespace App\Http\Controllers;

use App\Company;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class companyController extends Controller
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
        $this->authorize('viewAny', new Company);
        $search = $request->get('search');
        $type = $request->get('type');
        $companies = Company::orderBy('id', 'DESC')
            ->search($search, $type)
            ->paginate(4);
        return view('company.index', compact('companies', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', new Company);
        return view('company.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', new Company);
        $validData = $request->validate([
            'name' => 'required',
            'nit' => 'required|unique:companies'
        ]);
        $company = new Company();
        $company->name = $validData['name'];
        $company->nit = $validData['nit'];
        $company->save();
        return redirect()->route('companies.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $company = Company::findOrFail($id);
        $this->authorize('update', $company);
        return view('company.edit', [
            'company' => $company
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
        $company = Company::findOrFail($id);
        $this->authorize('update', $company);
        $validData = $request->validate([
            'name' => 'required',
            'nit' => [
                'required',
                Rule::unique('companies')->ignore($id)
            ],
        ]);
        $company->name = $validData['name'];
        $company->nit = $validData['nit'];
        $company->save();
        return redirect()->route('companies.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $company = Company::findOrFail($id);
        $this->authorize('delete', $company);
        $company->delete();
        return redirect()->route('companies.index');
    }

    public function confirmDelete($id)
    {
        $company = Company::findOrFail($id);
        $this->authorize('delete', $company);
        return view('company.confirmDelete', [
            'company' => $company
        ]);
    }
}
