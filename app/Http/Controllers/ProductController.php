<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    // Get a list of products
    public function viewProductsList()
    {
        $products = Product::select(['id', 'slug', 'name', 'price', 'total_quantity', 'sold_quantity', 'available_quantity', 'created_by'])
        ->with("createdBy:id,name,email")
        ->orderBy('id', 'desc')
        ->paginate(8);

        // return $products;

        return view('products', compact('products'));
    }
}
