<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Events\EmailEvent;
use App\Mail\NewProduct;
use App\Category;
use App\Product;
use App\User;
use Auth;

class ProductController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     * 
     * @param \Illuminate\Http\Request
     * 
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $q = $request->has('q')
            ? $request->q 
            : '';
        $products = Product::where('name', 'LIKE', '%' . $q . '%')->paginate(5);

        return view('products.index')->with('products', $products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('products.create')->with('categories', $categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $product = new Product();
        
        $product->name = $request->input('name');
        if ($request->has('description'))
            $product->description = $request->input('description');
        $product->price = $request->input('price');
        if ($request->has('URL'))
            $product->URL = $request->input('URL');
        $product->active = $request->input('active') ? true : false;
        $product->user_id = auth()->id();
        $product->categories_id =$request->input('selectedCategory');

        if ($product->save()) { 
            event(new EmailEvent());
            return redirect('/products');
        }
        return redirect()->back()
            ->withErrors(['error_message' => 'Could not create new product.']);
    }
   
    /**
     * Remove the specified resource from storage.
     * 
     * @param  \App\product $product
     * @param  int  $id
     * 
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $curentId = Auth::user();
        if ($curentId->id == $product->user_id && $product->delete()) {
            return redirect()->back();
        }
        return redirect()
            ->back()
            ->withErrors(['error_message' => 'Could not delete a product that is not yours.']);
    }
}
