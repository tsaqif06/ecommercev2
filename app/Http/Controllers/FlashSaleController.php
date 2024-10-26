<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class FlashSaleController extends Controller
{
    public function index()
    {
        $products = Product::getAllProduct();

        $flashSaleProducts = Product::where('status', 'active')
            ->where('flash_sale_start', '<=', now())
            ->where('flash_sale_end', '>=', now())
            ->pluck('id');

        return view('backend.flashsale.index')->with([
            'products' => $products,
            'flashSaleProducts' => $flashSaleProducts,
        ]);
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id); // Mengambil produk berdasarkan ID
        return view('backend.flashsale.edit', compact('product')); // Mengirim produk ke view
    }

    // Mengupdate flash sale produk
    public function update(Request $request, $id)
    {
        $request->validate([
            'flash_sale_discount' => 'required|numeric|min:0|max:100', // Validasi diskon
            'flash_sale_start' => 'required|date', // Validasi waktu mulai
            'flash_sale_end' => 'required|date|after:flash_sale_start', // Validasi waktu selesai
        ]);

        $product = Product::findOrFail($id); // Mengambil produk berdasarkan ID
        $product->flash_sale_discount = $request->flash_sale_discount; // Menyimpan diskon
        $product->flash_sale_start = $request->flash_sale_start; // Menyimpan waktu mulai
        $product->flash_sale_end = $request->flash_sale_end; // Menyimpan waktu selesai
        $product->save(); // Menyimpan perubahan ke database

        return redirect()->route('flashsale.index')->with('success', 'Flash Sale updated successfully!'); // Redirect dengan pesan sukses
    }

    public function destroy($id)
    {
        // Menghapus flash sale dengan mengatur kolom terkait ke null
        $product = Product::findOrFail($id);
        $product->flash_sale_start = null;
        $product->flash_sale_end = null;
        $product->flash_sale_discount = null;
        $product->save();

        return redirect()->route('flashsale.index')->with('success', 'Flash Sale berhasil dihapus.');
    }
}
