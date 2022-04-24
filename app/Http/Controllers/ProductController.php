<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with(['category', 'images'])->paginate(env("PAGINATION_COUNT"));
        $currencyCode = env("CURRENCY_CODE", "$");
        return view('admin.products.products')->with([
            'products' => $products,
            'currency_code' => $currencyCode,
        ]);

    }

    public function newProduct($id = null)
    {

        $product = null;
        $unit = Unit::all();
        $categories = Category::all();
        if (!is_null($id)) {
            $product = Product::with(['hasUnit', 'category'])->find($id);

        }
        return view('admin.products.new-product')->with([
            'product' => $product,
            'units' => $unit,
            'categories' => $categories


        ]);


    }

    public function delete(Request $request)
    {

        $request->validate(
            [
                'product_id' => 'required'
            ]);


        $productId = $request->input("product_id");
        $product = Product::destroy($productId);
        Session::flash("message", "sussfully delete  the product");
        return redirect()->back();


    }


    public function store(Request $request)
    {
        $request->validate(
            [

                'product_title' => 'required',
                'product_description' => 'required',
                'product_unit' => 'required',
                'prodcut_price' => 'required',
                'product_discount' => 'required',
                'prodcut_total' => 'required',
                'product_category' => 'required',

            ]);
        $product = new Product();
        $product->title = $request->input('product_title');
        $product->description = $request->input('product_description');
        $product->unit = intval($request->input('product_unit'));
        $product->price = doubleval($request->input('prodcut_price'));
        $product->total = doubleval($request->input('prodcut_total'));
        $product->category_id = intval($request->input('product_category'));
        $product->discount = doubleval($request->input('product_discount'));

        if ($request->has('options')) {

            $optionArray = [];
            $options = array_unique($request->input('options'));
            foreach ($options as $option) {
                $actualOptions = $request->input($option);

                $optionArray[$option] = [];
                if (!empty($optionArray))
                    foreach ($actualOptions as $actualOption) {
                        array_push($optionArray[$option], $actualOption);
                    }
            }

            $product->options = json_encode($optionArray);


        }


        $product->save();
        if ($request->hasFile('product_images')) {
            $images = $request->file('product_images');
            foreach ($images as $image) {
                $path = $image->store('public');
                $image = new Image();
                $image->url = $path;
                $image->product_id = $product->id;
                $image->save();

            }


        }

        Session::flash("message", "Product has been added ");
        return redirect(route('products'));


    }

    public function update(Request $request)
    {

        dd($request);

    }


}
