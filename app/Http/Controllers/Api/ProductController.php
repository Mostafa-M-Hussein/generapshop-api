<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProdcutResource;
use App\Http\Resources\TagResource;
use App\Models\Product;
use App\Models\Tag;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return ProdcutResource::collection(Product::paginate());

    }


    public function show($id)
    {
        return new ProdcutResource(Product::find($id));

    }
}
