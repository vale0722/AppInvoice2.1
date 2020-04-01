<?php

namespace App\Http\Controllers;

use App\Invoice;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProductController extends Controller
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
        $this->authorize('viewAny', new Product());
        $search = $request->get('search');
        $type = $request->get('type');
        $products = Product::orderBy('id', 'DESC')
            ->search($search, $type)
            ->paginate(4);
        return view('product.index', compact('products', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', new Product());
        return view('product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', new Product());
        $validData = $request->validate([
            'name' => 'required',
            'code' => 'required|unique:products',
            'price' => 'required'
        ]);
        $product = new Product();
        $product->name = $validData['name'];
        $product->price = $validData['price'];
        $product->code = $validData['code'];
        $product->save();
        return redirect('/products');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $this->authorize('update', $product);
        return view('product.edit', [
            'product' => $product
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
        $product = Product::findOrFail($id);
        $this->authorize('update', $product);
        $validData = $request->validate([
            'name' => 'required',
            'code' => [
                'required',
                Rule::unique('products')->ignore($id),
            ],
            'price' => 'required'
        ]);
        $product->name = $validData['name'];
        $product->price = $validData['price'];
        $product->code = $validData['code'];
        $product->save();
        return redirect('/products');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $this->authorize('delete', $product);
        $product->delete();
        return redirect('/products');
    }

    public function confirmDelete($id)
    {
        $product = Product::findOrFail($id);
        $this->authorize('delete', $product);
        return view('Product.confirmDelete', [
            'product' => $product
        ]);
    }
}
