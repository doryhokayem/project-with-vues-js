<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Product;
use App\Search;

class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     * @param \Illiminate\Http\Request
     * 
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $q = $request->get('q');
        $products = Product::where('name', 'LIKE', '%' . $q . '%')->get();
        if (count($products) > 0)
            return view('products.search')->withDetails($products)->withQuery($q);
    }
}
