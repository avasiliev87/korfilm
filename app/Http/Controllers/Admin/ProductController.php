<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Models\Product;

class ProductController extends Controller
{
	public function index(Request $request)
	{
		$products = Product::all();

		return view('admin.products.index', [ 'products' => $products ]);
	}
}
