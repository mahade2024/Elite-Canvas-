<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart; 
use App\Models\Order;
use App\Models\ProductVariant;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display all products on the homepage.
     */
    function index()
    {
        $data = Product::with('variants')->get();
        return view('product', ['products' => $data]);
    }

    /**
     * Display specific product details with variants and gallery.
     */
    function detail($id)
    {
        $data = Product::with(['variants', 'galleryImages'])->find($id);
        if(!$data) {
            return redirect('/')->with('error', 'Product not found');
        }
        return view('detail', ['product' => $data]);
    }

    /**
     * Search products by name or category.
     */
    function search(Request $req)
    {
        $query = $req->input('query');
        $data = Product::with('variants')
            ->where('name', 'like', '%' . $query . '%')
            ->orWhere('category', 'like', '%' . $query . '%')
            ->get();
        return view('product', ['products' => $data]);
    }

    /**
     * Add to cart and redirect immediately to checkout.
     */
    function buyNow(Request $req)
    {
        $this->addToCart($req);
        return redirect('/ordernow');
    }

    /**
     * Add a specific variant to the cart (Session or Database).
     */
    function addToCart(Request $req)
    {
        $variantId = $req->input('variant_id'); 

        if (Session::has('user')) {
            $cart = new Cart;
            $cart->user_id = Session::get('user')['id'];
            $cart->product_id = $variantId; 
            $cart->save();
        } else {
            $cart = session()->get('cart', []);
            $cart[] = $variantId;
            session()->put('cart', $cart);
        }
        return redirect()->back();
    }

    /**
     * Save a new product with multiple gallery images and variants with images.
     */
    public function saveProduct(Request $req)
    {
        $product = new Product;
        $product->name = $req->name;
        $product->category = $req->category;
        $product->description = $req->description;
        $product->product_type = 'variable';

        // Main Thumbnail
        if ($req->hasFile('main_image')) {
            $name = time().'_main_'.$req->file('main_image')->getClientOriginalName();
            $req->file('main_image')->move(public_path('uploads/products'), $name);
            $product->gallery = 'uploads/products/'.$name; 
        }
        $product->save();

        // Save Extra Gallery Images
        if ($req->hasFile('gallery_images')) {
            foreach ($req->file('gallery_images') as $file) {
                $gName = time().'_gal_'.$file->getClientOriginalName();
                $file->move(public_path('uploads/gallery'), $gName);
                DB::table('product_images')->insert([
                    'product_id' => $product->id,
                    'image_path' => 'uploads/gallery/'.$gName,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        // Save Variants and their specific images
        if ($req->variant_names) {
            foreach ($req->variant_names as $key => $vName) {
                $vImagePath = null;
                if ($req->hasFile('variant_images') && isset($req->file('variant_images')[$key])) {
                    $vFile = $req->file('variant_images')[$key];
                    $vFileName = time().'_var_'.$vFile->getClientOriginalName();
                    $vFile->move(public_path('uploads/variants'), $vFileName);
                    $vImagePath = 'uploads/variants/'.$vFileName;
                }

                DB::table('product_variants')->insert([
                    'product_id' => $product->id,
                    'variant_name' => $vName,
                    'price' => $req->variant_prices[$key],
                    'variant_image' => $vImagePath,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
        return redirect('/')->with('success', 'Product uploaded!');
    }
    
    /**
     * Show items in cart using Variant Image as priority.
     */
    function cartList()
    {
        $products = [];
        if (Session::has('user')) {
            $userId = Session::get('user')['id'];
            $products = DB::table('cart')
                ->join('product_variants', 'cart.product_id', '=', 'product_variants.id')
                ->join('products', 'product_variants.product_id', '=', 'products.id')
                ->where('cart.user_id', $userId)
                ->select(
                    'products.name', 
                    'products.category',
                    DB::raw('COALESCE(product_variants.variant_image, products.gallery) as gallery'), 
                    'product_variants.price', 
                    'product_variants.variant_name', 
                    'product_variants.id as id',
                    'cart.id as cart_id'
                )
                ->get();
        } else {
            $variantIds = Session::get('cart', []);
            if (!empty($variantIds)) {
                $products = DB::table('product_variants')
                    ->join('products', 'product_variants.product_id', '=', 'products.id')
                    ->select(
                        'products.name', 
                        'products.category',
                        DB::raw('COALESCE(product_variants.variant_image, products.gallery) as gallery'), 
                        'product_variants.price', 
                        'product_variants.variant_name',
                        'product_variants.id as id'
                    )
                    ->whereIn('product_variants.id', $variantIds)
                    ->get();
            }
        }
        return view('cartlist', ['products' => $products]);
    }

    /**
     * Remove item from cart.
     */
    public function removeCart($id)
    {
        if (Session::has('user')) {
            DB::table('cart')->where('id', $id)->delete();
        } else {
            $cart = session()->get('cart', []);
            foreach ($cart as $key => $value) {
                if ($value == $id) {
                    unset($cart[$key]);
                    break;
                }
            }
            session()->put('cart', array_values($cart));
        }
        return redirect()->back()->with('success', 'Item removed from cart');
    }

    /**
     * Show Checkout page with totals and correct variant images.
     */
    function orderNow()
    {
        $userId = Session::get('user')['id'] ?? null;
        
        if ($userId) {
            $products = DB::table('cart')
                ->join('product_variants', 'cart.product_id', '=', 'product_variants.id')
                ->join('products', 'product_variants.product_id', '=', 'products.id')
                ->where('cart.user_id', $userId)
                ->select(
                    'products.name', 
                    DB::raw('COALESCE(product_variants.variant_image, products.gallery) as gallery'), 
                    'product_variants.price', 
                    'product_variants.variant_name'
                )
                ->get();
        } else {
            $variantIds = Session::get('cart', []);
            if(empty($variantIds)) return redirect('/');
            
            $products = DB::table('product_variants')
                ->join('products', 'product_variants.product_id', '=', 'products.id')
                ->whereIn('product_variants.id', $variantIds)
                ->select(
                    'products.name', 
                    DB::raw('COALESCE(product_variants.variant_image, products.gallery) as gallery'), 
                    'product_variants.price', 
                    'product_variants.variant_name'
                )
                ->get();
        }

        $total = $products->sum('price');
        return view('ordernow', ['products' => $products, 'total' => $total]);
    }

    /**
     * Display the order history for a user or guest.
     */
    public function myOrders()
    {
        $userId = Session::get('user')['id'] ?? null;
        $guestPhone = Session::get('guest_phone') ?? null;

        $query = DB::table('orders')
            ->join('product_variants', 'orders.product_id', '=', 'product_variants.id')
            ->join('products', 'product_variants.product_id', '=', 'products.id')
            ->select(
                'orders.*', 
                'products.name', 
                DB::raw('COALESCE(product_variants.variant_image, products.gallery) as gallery'), 
                'product_variants.price as product_price', 
                'product_variants.variant_name'
            );

        if ($userId) {
            $orders = $query->where('orders.user_id', $userId)->get();
        } else {
            $orders = $query->where('orders.phone', $guestPhone)->whereNull('orders.user_id')->get();
        }

        return view('myorders', ['orders' => $orders]);
    }

    /**
     * Process the order, save Thana and TrxID, and clear the cart.
     */
    function orderPlace(Request $req)
    {
        $userId = Session::get('user')['id'] ?? null;
        
        // 1. Get items from cart
        if ($userId) {
            $cartItems = Cart::where('user_id', $userId)->get();
        } else {
            $variantIds = Session::get('cart', []);
            $cartItems = collect($variantIds)->map(function($id) {
                return (object)['product_id' => $id];
            });
        }

        if ($cartItems->isEmpty()) {
            return redirect('/')->with('error', 'Cart is empty');
        }

        // 2. Loop and Save
        foreach ($cartItems as $item) {
            $order = new Order;
            $order->product_id = $item->product_id;
            $order->user_id = $userId;
            
            // --- THESE ARE THE MISSING FIELDS CAUSING THE ERROR ---
            $order->name = $req->name;
            $order->phone = $req->phone;
            $order->email = $req->email;
            $order->delivery_area = $req->thana; // This maps 'thana' from form to 'delivery_area'
            $order->address = $req->address;
            $order->note = $req->note;
            // ------------------------------------------------------

            $order->payment_method = $req->payment;
            $order->status = "pending";

            if ($req->payment == 'cash') {
                $order->payment_status = "pending";
                $order->transaction_id = "N/A";
            } else {
                $order->payment_status = "waiting_verification";
                $order->transaction_id = ($req->payment == 'bkash') ? $req->bkash_trx : $req->nagad_trx;
            }

            $order->save();
        }

        // 3. Clear Cart
        if ($userId) {
            Cart::where('user_id', $userId)->delete();
        } else {
            Session::forget('cart');
        }

        return redirect('/')->with('success', 'Order placed successfully!');
    }
}