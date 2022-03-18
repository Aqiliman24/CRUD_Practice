<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Auth;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $status = $request->status;
        $page = $request->page ?? 1;
        $per_page = $request->per_page ?? 5;


        if ($status=='deleted'){

            $products = Auth::user()->deleted_products()->paginate($per_page);

        }else{
            if ($request->get('keyword') != null)
            {
                $keyword = $request->get('keyword');
                $products = Auth::user()->products()->where('name','LIKE','%'.$keyword.'%')->paginate($per_page);
                // dd($products);
            }
            else
            {
                $products = Auth::user()->products()->paginate($per_page);
            }

                // $products = Auth::user()->products()->paginate($per_page);
        }

        
        
        // $products = Product::latest()->paginate(5);
        // dd($products);

        return view('products.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'quantity'=>'required|integer',
            'detail' => 'required',
        ]);

        Auth::user()->products()->create($request->all());
    
        // Product::create($request->all()+['user_id'=>Auth::user()->id]);
     
        return redirect()->route('products.index')
                        ->with('success','Product created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('products.show',compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('products.edit',compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required',
            'quantity'=>'required|integer',
            'detail' => 'required',
        ]);
    
        $product->update($request->all());
    
        return redirect()->route('products.index')
                        ->with('success','Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
    
        return redirect()->route('products.index')
                        ->with('success','Product deleted successfully');
    }

    public function restore($product)
    {
        $product = Product::onlyTrashed()->find($product);
        $product->restore();

        return back()->with('success', 'Product Restore successfully');
    }

    public function restoreAll()
    {
        $product = Product::onlyTrashed()->restore();
        // dd($product);
        return back()->with('success', 'All Product Restored successfully');
    }

    public function __contruct()
    {
        $this->middleware('auth');
    }

    
}