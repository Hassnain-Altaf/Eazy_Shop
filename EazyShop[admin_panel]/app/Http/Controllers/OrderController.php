<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Orders;
use App\Models\User;
use App\Models\CartProduct;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    public function storeOrders(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'billing_first_name' => 'required|string',
            'billing_last_name' => 'required|string',
            'billing_email' => 'required|string|email',
            'billing_address' => 'required|string',
            'billing_phone' => 'required|string',
            'billing_country' => 'required|string',
            'billing_state' => 'nullable|string',
            'billing_city' => 'required|string',
            'billing_zip' => 'nullable|string',
            'same_as_billing' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $order = new Orders();
        $order->user_id = session()->get('id');
        $order->billing_first_name = $request->input('billing_first_name');
        $order->billing_last_name = $request->input('billing_last_name');
        $order->billing_email = $request->input('billing_email');
        $order->billing_phone = $request->input('billing_phone');
        $order->billing_address = $request->input('billing_address');
        $order->billing_country = $request->input('billing_country');
        $order->billing_state = $request->input('billing_state');
        $order->billing_city = $request->input('billing_city');
        $order->billing_zip = $request->input('billing_zip');
        $order->total_amount = $request->input('total_amount', 0);


        if ($request->same_as_billing !== 'Checked') {
            $shippingValidator = Validator::make($request->all(), [
                'shipping_first_name' => 'required|string',
                'shipping_last_name' => 'required|string',
                'shipping_email' => 'required|string|email',
                'shipping_address' => 'required|string',
                'shipping_phone' => 'required|string',
                'shipping_country' => 'required|string',
                'shipping_state' => 'nullable|string',
                'shipping_city' => 'required|string',
                'shipping_zip' => 'nullable|string',
            ]);

            if ($shippingValidator->fails()) {
                return redirect()->back()->withErrors($shippingValidator)->withInput();
            }

            $order->user_id = session()->get('id');
            $order->shipping_first_name = $request->input('shipping_first_name');
            $order->shipping_last_name = $request->input('shipping_last_name');
            $order->shipping_email = $request->input('shipping_email');
            $order->shipping_phone = $request->input('shipping_phone');
            $order->shipping_address = $request->input('shipping_address');
            $order->shipping_country = $request->input('shipping_country');
            $order->shipping_state = $request->input('shipping_state');
            $order->shipping_city = $request->input('shipping_city');
            $order->shipping_zip = $request->input('shipping_zip');
            // $order->total_amount = $request->input('total_amount', 0);


        } else {
            $order->user_id = session()->get('id');
            $order->shipping_first_name = $order->billing_first_name;
            $order->shipping_last_name = $order->billing_last_name;
            $order->shipping_email = $order->billing_email;
            $order->shipping_phone = $order->billing_phone;
            $order->shipping_address = $order->billing_address;
            $order->shipping_country = $order->billing_country;
            $order->shipping_state = $order->billing_state;
            $order->shipping_city = $order->billing_city;
            $order->shipping_zip = $order->billing_zip;
            // $order->total_amount = $request->total_amount;
        }

        $order->save();

        return redirect()->back()->with('success', 'Order placed successfully!');
    }


    public function SeeCartProducts(Request $request)
    {
        $userId = session()->get('id');
        if (!$userId) {
            return redirect()->route('signin')->with('error', 'Please login to view the cart');
        }

        $user = User::find($userId);
        $cartItems = CartProduct::where('user_id', $userId)->get();
        return view('pages.checkout', compact('cartItems'));
    }

}
