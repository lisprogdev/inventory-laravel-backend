<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
public function index()
{
    $products = Product::latest()->get();

    return response()->json([
        'success' => true,
        'data' => $products
    ]);
}

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $fileName = null;
        if ($request->hasFile('image')) {
            $fileName = time() . '_' . $request->image->getClientOriginalName();
            $request->image->storeAs('public/product/image', $fileName);
        }

        Product::create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $fileName
        ]);

        return redirect()->route('products.index')
            ->with('success', 'Produk berhasil dibuat.');
    }

    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $fileName = $product->image;
        if ($request->hasFile('image')) {
            $fileName = time() . '_' . $request->image->getClientOriginalName();
            $request->image->storeAs('public/product/image', $fileName);
        }

        $product->update([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $fileName
        ]);

        return redirect()->route('products.index')
            ->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(Product $product)
{
    // Hapus file gambar jika ada
    if ($product->image && \Storage::exists('public/product/image/' . $product->image)) {
        \Storage::delete('public/product/image/' . $product->image);
    }

    $product->delete();

    return response()->json([
        'success' => true,
        'message' => 'Produk berhasil dihapus.'
    ]);
}

}
