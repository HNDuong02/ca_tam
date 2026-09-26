<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::where('status', 1);

        if ($request->has('category') && $request->category != '') {
            $category = Category::where('slug', $request->category)->first();
            if ($category) {
                $query->where('category_id', $category->id);
            }
        }

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('short_description', 'LIKE', "%{$search}%")
                  ->orWhere('body_html', 'LIKE', "%{$search}%");
            });
        }

        $products = $query->paginate(12);
        $categories = Category::orderBy('order')->get();
        
        return view('products.index', compact('products', 'categories'));
    }

    public function show($slug)
    {
        $product = Product::where('slug', $slug)->where('status', 1)->firstOrFail();
        
        // Fetch related products from the same category
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('status', 1)
            ->take(4)
            ->get();
            
        return view('products.show', compact('product', 'relatedProducts'));
    }
}
