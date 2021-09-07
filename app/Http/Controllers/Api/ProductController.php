<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;


class ProductController extends Controller
{
    public function index(){

        //dd($request->all());die();
        $product = Product::all();

        return response()->json([
            'success' => 1,
            'message' => 'Get Product Successfull ',
            'products' => $product
        ]);
        
    }
}
