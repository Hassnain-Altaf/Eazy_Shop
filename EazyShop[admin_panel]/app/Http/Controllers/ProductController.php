<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Categories;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;



class ProductController extends Controller
{
    public function AddCategory(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'size' => ['required', 'string', 'max:255'],
            'quantity' => ['string',]
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $category = new Categories();
        $category->name = $request->input('name');
        $category->size = $request->input('size');
        $category->quantity = $request->input('quantity');
        $category->save();

        return redirect()->back()->with('status', 'Category added successfull!');
    }

    public function ShowCategories()
    {

        $categories = Categories::all();
        return view('Admin.Productlisting', compact('categories'));

    }

    public function ListProduct(Request $request)
    {
        
        $request->validate([
            'productname' => 'required|string',
            'productdescription' => 'required|string',
            'stockquantity' => 'required|string',
            'totalprice' => 'required|string',
            'discount' => 'required|string',
            'category' => 'required|string',
            'size' => 'required|string',
            'tags' => 'required|string',
            'image' => 'image|mimes:jpeg,png,jpg,gif,webp,svg|max:2048',
        ]);

        $product = new Product;
        $product->productname = $request->input('productname');
        $product->productdescription = $request->input('productdescription');
        $product->stockquantity = $request->input('stockquantity');
        $product->totalprice = $request->input('totalprice');
        $product->discount = $request->input('discount');
        $product->category = $request->input('category');
        $product->size = $request->input('size');
        $product->tags = $request->input('tags');
        $product->status = $request->input('status');

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('ProductImages', 'public');
            $product->image = $imagePath;
            // $imageUrl = Storage::url($imagePath);
        }

        $product->save();
        return redirect()->route('add-product')->with('success', 'Product added successfully');
    }

    public function ShowProducts()
    {

        $products = Product::all();
        return view('Pages.Index', compact('products'));

    }
    public function ShowProductDetail($id)
    {
        $products = Product::findOrFail($id);
        $otherProducts = Product::where('id', '!=', $id)->get();
    
        return view('Pages.Shopdetail', compact('products','otherProducts'));
    }
    

}
