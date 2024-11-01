<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;

use Illuminate\Http\Request;
use App\Models\ProductVariant;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::getAllProduct();
        // return $products;
        return view('backend.product.index')->with('products', $products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (auth()->user()->role == 'admin') {
            $brand = Brand::get();
            $category = Category::where('is_parent', 1)->get();
            // return $category;
            return view('backend.product.create')->with('categories', $category)->with('brands', $brand);
        } else {
            return redirect()->route('admin')->with('error', 'You do not have permission to access this page.');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validasi input
        $this->validate($request, [
            'title' => 'string|required',
            'summary' => 'string|required',
            'description' => 'string|nullable',
            'photo' => 'string|required',
            'size' => 'array|required', // 'size' sebagai array untuk beberapa ukuran
            'quantity' => 'array|required', // 'quantity' untuk setiap ukuran
            'stock' => 'nullable|numeric',
            'brand_id' => 'nullable|exists:brands,id',
            'child_cat_id' => 'nullable|exists:categories,id',
            'is_featured' => 'sometimes|in:1',
            'status' => 'required|in:active,inactive',
            'condition' => 'required|in:default,new,hot',
            'price' => 'required|numeric',
            'discount' => 'nullable|numeric'
        ]);

        $data = $request->all();
        $slug = Str::slug($request->title);
        $count = Product::where('slug', $slug)->count();
        if ($count > 0) {
            $slug = $slug . '-' . date('ymdis') . '-' . rand(0, 999);
        }
        $data['slug'] = $slug;
        $data['is_featured'] = $request->input('is_featured', 0);

        // Simpan data utama produk
        $product = Product::create($data);

        // Simpan ukuran dan quantity
        $sizes = $request->input('size', []);
        $quantities = $request->input('quantity', []);
        foreach ($sizes as $index => $size) {
            ProductVariant::create([
                'product_id' => $product->id,
                'size' => $size,
                'quantity' => $quantities[$index] ?? 0,
            ]);
        }

        return redirect()->route('product.index')->with('success', 'Product Successfully added with sizes and quantities');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (auth()->user()->role == 'admin') {
            $brand = Brand::get();
            $product = Product::findOrFail($id);
            $category = Category::where('is_parent', 1)->get();
            $items = Product::where('id', $id)->get();
            // return $items;
            return view('backend.product.edit')->with('product', $product)
                ->with('brands', $brand)
                ->with('categories', $category)->with('items', $items);
        } else {
            return redirect()->route('admin')->with('error', 'You do not have permission to access this page.');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        // Validasi input
        $this->validate($request, [
            'title' => 'string|required',
            'summary' => 'string|required',
            'description' => 'string|nullable',
            'photo' => 'string|required',
            'size' => 'array|required', // 'size' sebagai array
            'quantity' => 'array|required', // 'quantity' untuk setiap ukuran
            'stock' => 'nullable|numeric',
            'brand_id' => 'nullable|exists:brands,id',
            'child_cat_id' => 'nullable|exists:categories,id',
            'is_featured' => 'sometimes|in:1',
            'status' => 'required|in:active,inactive',
            'condition' => 'required|in:default,new,hot',
            'price' => 'required|numeric',
            'discount' => 'nullable|numeric'
        ]);

        $data = $request->all();
        $data['is_featured'] = $request->input('is_featured', 0);

        // Update produk utama
        $product->fill($data)->save();

        // Hapus semua variant lama untuk produk ini, lalu simpan yang baru
        ProductVariant::where('product_id', $id)->delete();
        $sizes = $request->input('size', []);
        $quantities = $request->input('quantity', []);
        foreach ($sizes as $index => $size) {
            ProductVariant::create([
                'product_id' => $product->id,
                'size' => $size,
                'quantity' => $quantities[$index] ?? 0,
            ]);
        }

        return redirect()->route('product.index')->with('success', 'Product successfully updated with sizes and quantities');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        // Hapus semua variant terkait produk
        ProductVariant::where('product_id', $product->id)->delete();

        // Hapus produk utama
        $status = $product->delete();

        if ($status) {
            request()->session()->flash('success', 'Product successfully deleted');
        } else {
            request()->session()->flash('error', 'Error while deleting product');
        }
        return redirect()->route('product.index');
    }
}
