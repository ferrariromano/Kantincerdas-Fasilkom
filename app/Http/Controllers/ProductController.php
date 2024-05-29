<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function listActiveProducts()
    {
        $categories = Category::all();
        $products = Product::where('status', 'Aktif')->get();

        $nama_tenant = [
            1 => 'Left Canteen',
            2 => 'Right Canteen'
        ];

        return view('menu.index', [
            'active' => 'menu',
            'products' => $products,
            'categories' => $categories,
            'nama_tenant' => $nama_tenant
        ]);
    }

    public function index()
    {
        // Ambil tenant_id dari sesi
        $tenant_id = session('tenant_id');

        // Jika tenant_id tidak ada di sesi, redirect ke halaman lain atau tampilkan pesan error
        if (!$tenant_id) {
            return redirect()->route('login')->withErrors(['tenant_id' => 'Tenant ID is missing.']);
        }

        // Ambil produk berdasarkan tenant_id dengan pagination
        $products = Product::where('tenant_id', $tenant_id)->paginate(10);
        $categories = Category::all();

        // Dapatkan nama tenant dari sesi
        $nama_tenant = session('tenant_name');

        return view('products.index', [
            'products' => $products,
            'categories' => $categories,
            'nama_tenant' => $nama_tenant
        ]);
    }

    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        // Ambil tenant_id dari sesi
        $tenant_id = session('tenant_id');

        // Pastikan tenant_id sudah terisi
        if (!$tenant_id) {
            return redirect()->back()->withErrors(['tenant_id' => 'Tenant ID is missing.'])->withInput();
        }

        $request->validate([
            'category_id' => 'required',
            'name' => 'required',
            'price' => 'required|numeric',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'required',
            'status' => 'required|in:Aktif,Tidak Aktif',
        ]);

        $imagePath = $request->file('image')->store('images', 'public');

        Product::create([
            'category_id' => $request->category_id,
            'tenant_id' => $tenant_id, // Set tenant_id menggunakan nilai dari sesi
            'name' => $request->name,
            'price' => $request->price,
            'image' => $imagePath,
            'description' => $request->description,
            'status' => $request->status,
        ]);

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        // Ambil tenant_id dari sesi
        $tenant_id = session('tenant_id');

        // Pastikan tenant_id sudah terisi
        if (!$tenant_id) {
            return redirect()->back()->withErrors(['tenant_id' => 'Tenant ID is missing.'])->withInput();
        }

        $request->validate([
            'category_id' => 'required',
            'name' => 'required',
            'price' => 'required|numeric',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'required',
            'status' => 'required|in:Aktif,Tidak Aktif',
        ]);

        $imagePath = $product->image;
        if ($request->hasFile('image')) {
            if ($imagePath) {
                Storage::disk('public')->delete($imagePath);
            }
            $imagePath = $request->file('image')->store('images', 'public');
        }

        $product->update([
            'category_id' => $request->category_id,
            'tenant_id' => $tenant_id, // Set tenant_id using value from session
            'name' => $request->name,
            'price' => $request->price,
            'image' => $imagePath,
            'description' => $request->description,
            'status' => $request->status,
        ]);

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}

