<?php

namespace App\Http\Controllers;

use App\Models\Product; 
use App\Models\ProductVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class AdminController extends Controller
{
    // --- ORDER METHODS ---
    public function index()
    {
        $orders = DB::table('orders')
            ->join('product_variants', 'orders.product_id', '=', 'product_variants.id')
            ->join('products', 'product_variants.product_id', '=', 'products.id')
            ->select(
                'orders.*', 
                'products.name as product_name', 
                'products.gallery as product_img', 
                'product_variants.variant_name'
            )
            ->orderBy('orders.id', 'desc')
            ->get();

        return view('admin.adminorders', ['orders' => $orders]);
    }

    public function updateStatus(Request $req)
    {
        DB::table('orders')->where('id', $req->order_id)->update(['status' => $req->status]);
        return redirect()->back()->with('success', 'Order status updated!');
    }

    public function deleteOrder(Request $req) 
    {
        DB::table('orders')->where('id', $req->order_id)->delete();
        return redirect()->back()->with('success', 'Order Deleted!');
    }

    // --- PRODUCT METHODS ---
   public function showProducts()
    {
        // Make sure this is NOT filtering by category, so it grabs everything
        $products = \App\Models\Product::with('variants')->orderBy('id', 'desc')->get();
        return view('admin.adminproducts', ['products' => $products]);
    }

    public function editProduct($id) {
    $product = \App\Models\Product::with('variants')->find($id);
    return view('admin.edit_product', ['product' => $product]);
    }

    public function updateProduct(Request $request) {
    $product = \App\Models\Product::find($request->id);

    // Update basic info
    $product->name = $request->name;
    $product->category = $request->category;
    $product->description = $request->description;

    // Handle new image upload
    if ($request->hasFile('gallery')) {
        $file = $request->file('gallery');
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $file->move('assets/catering-images/', $filename);
        $product->gallery = $filename;
    }

    $product->save();

    return redirect('/admin/products')->with('success', 'Product updated successfully!');
}
    


   

    public function addProduct(Request $req)
    {
        // 1. Create and Save Main Product
        $product = new Product;
        $product->name = $req->name;
        $product->category = $req->category;
        $product->description = $req->description;

        // Save main image from device to public/uploads/products
        if($req->hasFile('gallery')) {
            $file = $req->file('gallery');
            $filename = time() . '_main.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/products'), $filename);
            $product->gallery = 'uploads/products/' . $filename;
        }
        $product->save();

        // 2. Save Daily Variants (SAT, SUN, etc.) with their own images
        if ($req->variant_names) {
            foreach ($req->variant_names as $key => $vName) {
                if (!empty($vName)) { 
                    $variant = new ProductVariant;
                    $variant->product_id = $product->id;
                    $variant->variant_name = $vName;
                    $variant->price = $req->variant_prices[$key] ?? 0;

                    // Save daily image from device to public/uploads/variants
                    if (isset($req->file('variant_images')[$key])) {
                        $vFile = $req->file('variant_images')[$key];
                        $vFilename = time() . '_' . $vName . '.' . $vFile->getClientOriginalExtension();
                        $vFile->move(public_path('uploads/variants'), $vFilename);
                        $variant->variant_image = 'uploads/variants/' . $vFilename;
                    }
                    
                    $variant->save();
                }
            }
        }
        return redirect()->back()->with('success', 'Product and Daily Menus saved!');
    }

    public function deleteProduct(Request $req)
    {
        $product = Product::find($req->id);
        
        // Delete physical files from device storage
        if ($product && File::exists(public_path($product->gallery))) {
            File::delete(public_path($product->gallery));
        }
        
        if($product) { 
            $product->delete(); 
        }

        return redirect()->back()->with('success', 'Product removed successfully!');
    }
}