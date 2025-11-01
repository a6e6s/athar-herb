<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = session()->get('cart', []);
        return view('pages.cart', compact('cartItems'));
    }

    public function add(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($validated['product_id']);

        $cart = session()->get('cart', []);

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] += $validated['quantity'];
        } else {
            $cart[$product->id] = [
                'id' => $product->id,
                'name' => $product->name_ar,
                'price' => $product->discount_price ?? $product->price,
                'image' => $product->image,
                'quantity' => $validated['quantity'],
            ];
        }

        session()->put('cart', $cart);

        return response()->json([
            'success' => true,
            'cart_count' => array_sum(array_column($cart, 'quantity')),
            'message' => 'تمت إضافة المنتج إلى السلة'
        ]);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = $validated['quantity'];
            session()->put('cart', $cart);

            return response()->json([
                'success' => true,
                'cart_count' => array_sum(array_column($cart, 'quantity')),
            ]);
        }

        return response()->json(['success' => false], 404);
    }

    public function remove($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);

            return response()->json([
                'success' => true,
                'cart_count' => array_sum(array_column($cart, 'quantity')),
            ]);
        }

        return response()->json(['success' => false], 404);
    }

    public function wishlist()
    {
        $wishlistItems = session()->get('wishlist', []);
        return view('pages.wishlist', compact('wishlistItems'));
    }

    public function addToWishlist(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        $product = Product::findOrFail($validated['product_id']);

        $wishlist = session()->get('wishlist', []);

        if (!isset($wishlist[$product->id])) {
            $wishlist[$product->id] = [
                'id' => $product->id,
                'name' => $product->name_ar,
                'price' => $product->discount_price ?? $product->price,
                'image' => $product->image,
            ];
        }

        session()->put('wishlist', $wishlist);

        return response()->json([
            'success' => true,
            'wishlist_count' => count($wishlist),
            'message' => 'تمت إضافة المنتج إلى المفضلة'
        ]);
    }

    public function removeFromWishlist($id)
    {
        $wishlist = session()->get('wishlist', []);

        if (isset($wishlist[$id])) {
            unset($wishlist[$id]);
            session()->put('wishlist', $wishlist);

            return response()->json([
                'success' => true,
                'wishlist_count' => count($wishlist),
            ]);
        }

        return response()->json(['success' => false], 404);
    }
}
