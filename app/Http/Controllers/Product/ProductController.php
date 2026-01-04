<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
// use App\Models\Product;
use App\Models\Products\Product ;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{

public function index(Request $request)
{
    $perPage = $request->input('per_page', 12);

    $products = Product::when($request->search, function($q) use ($request){
            $search = $request->search;
            $q->where('name','LIKE', "%{$search}%")
              ->orWhere('sku','LIKE', "%{$search}%")
              ->orWhere('category','LIKE', "%{$search}%")
              ->orWhere('brand','LIKE', "%{$search}%");
        })
        ->orderBy('id','desc')
        ->paginate($perPage)
        ->withQueryString();

    return view('pages.product.index', compact('products', 'perPage'));
}

   public function create()
    {
         return view('pages.product.create');
    }


public function store(ProductRequest $request)
{
    DB::beginTransaction();
    try {
        $thumbnailName = null;
        if($request->hasFile('thumbnail')){
             if (!Storage::exists('public/products')) {
        Storage::makeDirectory('public/products');
    }

            $thumbnailName = 'product_' . Str::uuid() . '.' . $request->thumbnail->extension();
            $request->thumbnail->storeAs('products', $thumbnailName,'public');
        }




        Product::create([
            'name'        => $request->name,
            'sku'         => $request->sku,
            'category'    => $request->category,
            'brand'       => $request->brand,
            'description' => $request->description,
            'price'       => $request->price,
            'sale_price'  => $request->sale_price ?? null,
            'stock'       => $request->stock,
            'unit'        => $request->unit,
            'status'      => $request->status,
            'thumbnail'   => $thumbnailName,
        ]);

        DB::commit();
        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    } catch (\Exception $e) {
        DB::rollBack();
        return back()->withInput()->with('error', $e->getMessage());
    }
}

public function edit(Product $product)
{
    return view('pages.product.edit', compact('product'));
}

public function update(ProductRequest $request, Product $product)
{
    DB::beginTransaction();

    try {
        // 1. Handle thumbnail upload
        $thumbnailName = $product->thumbnail; // default to old thumbnail

        if ($request->hasFile('thumbnail')) {
            // Delete old thumbnail if exists
            if ($product->thumbnail && Storage::exists('public/products/' . $product->thumbnail)) {
                Storage::delete('public/products/' . $product->thumbnail);
            }

            // Store new file
            $file = $request->file('thumbnail');
            $thumbnailName = 'product_' . Str::uuid() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('products', $thumbnailName,'public');
        }

        // 2. Update product in DB
        $product->update([
            'name'        => $request->name,
            'sku'         => $request->sku,
            'category'    => $request->category,
            'brand'       => $request->brand,
            'description' => $request->description,
            'price'       => $request->price,
            'sale_price'  => $request->sale_price,
            'stock'       => $request->stock,
            'unit'        => $request->unit,
            'status'      => $request->status,
            'thumbnail'   => $thumbnailName,
        ]);

        DB::commit();

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');

    } catch (\Exception $e) {
        DB::rollBack();
        return back()->withInput()->with('error', $e->getMessage());
    }
}



public function destroy(Product $product)
{
    DB::beginTransaction();
    try {
        if($product->thumbnail && Storage::exists('public/products/' . $product->thumbnail)){
            Storage::delete('public/products/' . $product->thumbnail);
        }

        $product->delete();

        DB::commit();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    } catch (\Exception $e) {
        DB::rollBack();
        return back()->with('error', $e->getMessage());
    }
}
}
