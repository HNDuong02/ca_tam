<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('cart.index', compact('cart'));
    }

    public function add(Request $request)
    {
        $product = Product::findOrFail($request->product_id);
        $cart = session()->get('cart', []);
        
        $weight = $request->weight ?? '1kg - 2kg';
        $quantity = $request->quantity ?? 1;
        
        // Generate a unique ID based on product ID and weight selected
        $cartId = $product->id . '-' . md5($weight);

        if(isset($cart[$cartId])) {
            $cart[$cartId]['quantity'] += $quantity;
        } else {
            $cart[$cartId] = [
                "product_id" => $product->id,
                "name" => $product->name,
                "quantity" => $quantity,
                "price" => $product->price,
                "weight" => $weight,
                "image" => $product->image
            ];
        }

        session()->put('cart', $cart);
        
        if ($request->has('checkout') && $request->checkout == 1) {
            return redirect()->route('cart.index');
        }
        
        return redirect()->back()->with('success', 'Đã thêm sản phẩm vào giỏ hàng!');
    }
    
    public function update(Request $request)
    {
        if($request->cart_id && $request->quantity){
            $cart = session()->get('cart');
            if(isset($cart[$request->cart_id])) {
                $cart[$request->cart_id]["quantity"] = $request->quantity;
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Cập nhật giỏ hàng thành công');
        }
        return redirect()->route('cart.index');
    }

    public function remove(Request $request)
    {
        if($request->cart_id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->cart_id])) {
                unset($cart[$request->cart_id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Đã xóa sản phẩm khỏi giỏ hàng');
        }
        return redirect()->route('cart.index');
    }
}
