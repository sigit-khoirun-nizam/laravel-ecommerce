<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\ShippingInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    public function CategoryPage($id)
    {
        $category = Category::findOrFail($id);
        $products = Product::where('product_category_id', $id)->latest()->get();
        return view('frontend.category', compact('category', 'products'));
    }

    public function SingleProduct($id)
    {
        $product = Product::findOrFail($id);
        $subcat_id = Product::where('id', $id)->value('product_subcategory_id');
        $related_product = Product::where('product_subcategory_id', $subcat_id)->latest()->get();
        return view('frontend.product', compact('product', 'related_product'));
    }

    public function AddToCart()
    {
        $user_id = Auth::id();
        $cart_items = Cart::where('user_id', $user_id)->get();
        return view('frontend.cart', compact('cart_items'));
    }

    public function AddProductToCart(Request $request)
    {
        $product_price = $request->price;
        $quantity = $request->quantity;
        $price = $product_price * $quantity;

        Cart::insert([
            'product_id' => $request->product_id,
            'user_id' => Auth::id(),
            'quantity' => $request->quantity,
            'price' => $price
        ]);

        return redirect()->route('addtocart')->with('message', 'Your item added to cart success');
    }

    public function RemoveCartItem($id)
    {
        Cart::findOrFail($id)->delete();

        return redirect()->route('addtocart')->with('message', 'Your item removed to cart success');
    }

    public function GetShippingAddress()
    {
        return view('frontend.shippingaddress');
    }

    public function AddShippingAddress(Request $request)
    {
        ShippingInfo::insert([
            'user_id' => Auth::id(),
            'phone_number' => $request->phone_number,
            'city_name' => $request->city_name,
            'postal_code' => $request->postal_code,
        ]);

        return redirect()->route('checkout');
    }
    public function Checkout()
    {
        $user_id = Auth::id();
        $cart_items = Cart::where('user_id', $user_id)->get();
        $shipping_address = ShippingInfo::where('user_id', $user_id)->first();
        return view('frontend.checkout', compact('cart_items', 'shipping_address'));
    }

    public function PlaceOrder()
    {
        $user_id = Auth::id();
        $shipping_address = ShippingInfo::where('user_id', $user_id)->first();
        $cart_items = Cart::where('user_id', $user_id)->get();

        foreach ($cart_items as $item){
            Order::insert([
                'user_id' => $user_id,
                'shipping_phonenumber' => $shipping_address->phone_number,
                'shipping_city' => $shipping_address->city_name,
                'shipping_postalcode' => $shipping_address->postal_code,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'total_price' => $item->price,
            ]);

            $id = $item->id;
            Cart::findOrFail($id)->delete();
        }

        ShippingInfo::where('user_id', $user_id)->first()->delete();

        return redirect()->route('pendingorders')->with('message', 'Your Order Has Been Placed successfully');
    }
    public function UserProfile()
    {
        return view('frontend.userprofile');
    }

    public function PendingOrders()
    {
        $pending_orders = Order::where('status', 'pending')->latest()->get();
        return view('frontend.pendingorders', compact('pending_orders'));
    }

    public function History()
    {
        return view('frontend.history');
    }

    public function NewRelease()
    {
        return view('frontend.newrelease');
    }

    public function TodayDeal()
    {
        return view('frontend.todaydeal');
    }

    public function CustomerService()
    {
        return view('frontend.customerservice');
    }
}
