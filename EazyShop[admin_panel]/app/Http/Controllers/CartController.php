<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CartProduct;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    
    public function addToCart(Request $request)
    {
        if (session()->missing('id')) {
            return redirect()->route('signin')->with('error', '');
        }

        if (session()->has("id")) {
            $user = User::find(session()->get("id"));
            session()->put('id', $user->id);

            $productId = $request->input('id');

            $existingCartItem = CartProduct::where('user_id', $user->id)
                                        ->where('product_id', $productId)
                                        ->first();

            if ($existingCartItem) {
                if ($existingCartItem->quantity < 5) {
                    $existingCartItem->increment('quantity');
                    return redirect('/')->with('success', 'Product added to cart successfully!');
                } else {
                    return redirect('/')->with('error', 'Maximum quantity for this product is 5.');
                }
            } else {
                CartProduct::create([
                    'user_id' => $user->id,
                    'product_id' => $productId,
                    'quantity' => 1,
                ]);
            }

            return redirect()->route('cart.view')->with('success', 'Item added to cart successfully!');
        } else {
            $cart = session()->get('cart', []);
            $productId = $request->input('id');

            if (isset($cart[$productId])) {
                if ($cart[$productId]['quantity'] < 5) {
                    $cart[$productId]['quantity']++;
                } else {
                    return redirect()->route('cart.view')->with('error', 'Maximum quantity for this product is 5.');
                }
            } else {
                $cartData = [
                    'id' => $request->input('id'),
                    'name' => $request->input('name'),
                    'price' => $request->input('price'),
                    'image' => $request->input('image'),
                    'quantity' => 1, // Initial quantity set to 1
                ];

                $cart[$productId] = $cartData;
                session()->put('cart', $cart);
            }

            return redirect()->route('signin')->with('message', 'Please log in to add the product to your cart.');
        }
    }


    public function ViewCart()
    {
        $userId = session()->get('id');
        
        if (!$userId && !Auth::check()) {
            return redirect()->route('signin')->with('error', 'Please login to view the cart');
        }

        $user = User::find($userId ?? Auth::id()); // Fallback to logged-in user's ID if session ID is missing
        $cartItems = CartProduct::where('user_id', $user->id)->get();

        return view('pages.shopingcart', compact('cartItems'));
    }

    public function updateQuantity(Request $request, $itemId)
    {
        $cartItem = CartProduct::find($itemId);

        if (!$cartItem) {
            return response()->json(['success' => false, 'message' => 'Item not found']);
        }

        // Update the quantity
        $cartItem->quantity = $request->quantity;
        $cartItem->save();

        $updatedCartItems = CartProduct::where('user_id', $cartItem->user_id)->get(); // Fetch updated cart items for the user
        $totalPrice = $updatedCartItems->sum(function ($item) {
            return $item->product->totalprice * $item->quantity;
        });

        return response()->json([
            'success' => true,
            'updatedCartItems' => $updatedCartItems,
            'totalPrice' => $totalPrice
        ]);
    }


    public function removeCartItem($itemId)
    {
        if (session()->has('id')) {
            $user = User::find(session()->get('id'));
            $cartItem = CartProduct::where('user_id', $user->id)
                                ->where('id', $itemId)
                                ->first();
            
            if ($cartItem) {
                $cartItem->delete(); 
            }

            $updatedCartItems = CartProduct::where('user_id', $user->id)->get();
            $totalPrice = $updatedCartItems->sum(function ($item) {
                return $item->product->totalprice * $item->quantity;
            });

            return redirect()->route('cart.view')->with('success','Item removed successfully!');
        }

        return response()->json(['success' => false, 'message' => 'User not logged in']);
    }


}
