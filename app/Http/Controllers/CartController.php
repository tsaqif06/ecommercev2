<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Wishlist;
use App\Models\Cart;
use Illuminate\Support\Str;
use Helper;

class CartController extends Controller
{
    protected $product = null;
    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function addToCart(Request $request)
    {
        if (empty($request->slug) || empty($request->size)) {
            request()->session()->flash('error', 'Invalid Products');
            return back();
        }

        // Mengambil produk beserta variannya
        $product = Product::with('variants')->where('slug', $request->slug)->first();

        if (empty($product)) {
            request()->session()->flash('error', 'Invalid Products');
            return back();
        }

        // Mencari item di cart dengan produk dan ukuran yang sama
        $already_cart = Cart::where('user_id', auth()->user()->id)
            ->where('order_id', null)
            ->where('product_id', $product->id)
            ->where('size', $request->size) // Menambahkan pengecekan ukuran
            ->first();

        if ($already_cart) {
            $already_cart->quantity += 1; // Menambah kuantitas
            $already_cart->amount += $already_cart->price; // Mengupdate total amount

            // Memeriksa ketersediaan stok berdasarkan varian
            $variantQuantity = $product->variants()->where('size', $request->size)->first()->quantity;

            if ($variantQuantity < $already_cart->quantity || $variantQuantity <= 0) {
                return back()->with('error', 'Stock not sufficient!');
            }

            $already_cart->save();
        } else {
            $cart = new Cart;
            $cart->user_id = auth()->user()->id;
            $cart->product_id = $product->id;

            // Menghitung harga setelah diskon
            $price = ($product->price - ($product->price * $product->discount) / 100);
            $discount_flash = 0;

            if ($product->flash_sale_start <= now() && $product->flash_sale_end >= now()) {
                $discount_flash = $product->flash_sale_discount;
            }

            $cart->size = $request->size;
            $cart->price = ($price - ($price * ($discount_flash ?? 0)) / 100);
            $cart->quantity = 1; // Awalnya 1
            $cart->amount = $cart->price * $cart->quantity;

            // Memeriksa ketersediaan stok berdasarkan varian
            $variantQuantity = $product->variants()->where('size', $request->size)->first()->quantity;
            if ($variantQuantity < $cart->quantity || $variantQuantity <= 0) {
                return back()->with('error', 'Stock not sufficient!');
            }

            $cart->save();
        }

        request()->session()->flash('success', 'Product successfully added to cart');
        return back();
    }

    public function singleAddToCart(Request $request)
    {
        $request->validate([
            'slug' => 'required',
            'quant' => 'required',
            'size' => 'required',
        ]);

        // Mengambil produk beserta variannya
        $product = Product::with('variants')->where('slug', $request->slug)->first();

        if (empty($product)) {
            request()->session()->flash('error', 'Invalid Products');
            return back();
        }

        // Memeriksa apakah kuantitas melebihi stok
        if ($product->variants->sum('quantity') < $request->quant[1]) {
            return back()->with('error', 'Out of stock, You can add other products.');
        }

        if ($request->quant[1] < 1) {
            request()->session()->flash('error', 'Invalid quantity');
            return back();
        }

        // Mencari item di cart dengan produk dan ukuran yang sama
        $already_cart = Cart::where('user_id', auth()->user()->id)
            ->where('order_id', null)
            ->where('product_id', $product->id)
            ->where('size', $request->size) // Menambahkan pengecekan ukuran
            ->first();

        if ($already_cart) {
            $already_cart->quantity += $request->quant[1]; // Tambah kuantitas yang diminta
            $already_cart->amount += ($already_cart->price * $request->quant[1]); // Update total amount

            // Memeriksa ketersediaan stok berdasarkan varian
            $variantQuantity = $product->variants()->where('size', $request->size)->first()->quantity;

            if ($variantQuantity < $already_cart->quantity || $variantQuantity <= 0) {
                return back()->with('error', 'Stock not sufficient!');
            }

            $already_cart->save();
        } else {
            $cart = new Cart;
            $cart->user_id = auth()->user()->id;
            $cart->product_id = $product->id;

            // Menghitung harga setelah diskon
            $price = ($product->price - ($product->price * $product->discount) / 100);
            $discount_flash = 0;

            if ($product->flash_sale_start <= now() && $product->flash_sale_end >= now()) {
                $discount_flash = $product->flash_sale_discount;
            }

            $cart->size = $request->size;
            $cart->price = ($price - ($price * ($discount_flash ?? 0)) / 100);
            $cart->quantity = $request->quant[1]; // Menggunakan kuantitas dari request
            $cart->amount = ($cart->price * $request->quant[1]);

            // Memeriksa ketersediaan stok berdasarkan varian
            $variantQuantity = $product->variants()->where('size', $request->size)->first()->quantity;
            if ($variantQuantity < $cart->quantity || $variantQuantity <= 0) {
                return back()->with('error', 'Stock not sufficient!');
            }

            $cart->save();
        }

        request()->session()->flash('success', 'Product successfully added to cart.');
        return back();
    }



    public function cartDelete(Request $request)
    {
        $cart = Cart::find($request->id);
        if ($cart) {
            $cart->delete();
            request()->session()->flash('success', 'Cart successfully removed');
            return back();
        }
        request()->session()->flash('error', 'Error please try again');
        return back();
    }

    public function cartClear()
    {
        $cart = Cart::where('user_id', auth()->user()->id)->where('order_id', null)->get();

        if ($cart->isNotEmpty()) {
            foreach ($cart as $item) {
                $item->delete(); // Menghapus setiap item dalam cart
            }
            request()->session()->flash('success', 'Cart successfully removed');
        } else {
            request()->session()->flash('error', 'Error please try again');
        }

        return back();
    }


    public function cartUpdate(Request $request)
    {
        if ($request->quant) {
            $error = array();
            $success = '';

            foreach ($request->quant as $k => $quant) {
                $id = $request->qty_id[$k];
                $cart = Cart::find($id);

                if ($quant > 0 && $cart) {
                    // Menemukan varian berdasarkan ukuran pada keranjang
                    $variant = $cart->product->variants()->where('size', $cart->size)->first();

                    if (!$variant || $variant->quantity < $quant) {
                        request()->session()->flash('error', 'Out of stock');
                        return back();
                    }

                    $cart->quantity = ($variant->quantity > $quant) ? $quant : $variant->quantity;

                    if ($variant->quantity <= 0) continue;

                    // Menghitung harga setelah diskon
                    $price = ($cart->product->price - ($cart->product->price * $cart->product->discount) / 100);
                    $discount_flash = 0;

                    if (
                        $cart->product->flash_sale_start <= now() &&
                        $cart->product->flash_sale_end >= now()
                    ) {
                        $discount_flash = $cart->product->flash_sale_discount;
                    }

                    $after_price = ($price - ($price * ($discount_flash ?? 0)) / 100);
                    $cart->amount = $after_price * $quant;
                    $cart->save();

                    $success = 'Cart successfully updated!';
                } else {
                    $error[] = 'Cart Invalid!';
                }
            }

            return back()->with($error)->with('success', $success);
        } else {
            return back()->with('Cart Invalid!');
        }
    }

    // public function addToCart(Request $request){
    //     // return $request->all();
    //     if(Auth::check()){
    //         $qty=$request->quantity;
    //         $this->product=$this->product->find($request->pro_id);
    //         if($this->product->stock < $qty){
    //             return response(['status'=>false,'msg'=>'Out of stock','data'=>null]);
    //         }
    //         if(!$this->product){
    //             return response(['status'=>false,'msg'=>'Product not found','data'=>null]);
    //         }
    //         // $session_id=session('cart')['session_id'];
    //         // if(empty($session_id)){
    //         //     $session_id=Str::random(30);
    //         //     // dd($session_id);
    //         //     session()->put('session_id',$session_id);
    //         // }
    //         $current_item=array(
    //             'user_id'=>auth()->user()->id,
    //             'id'=>$this->product->id,
    //             // 'session_id'=>$session_id,
    //             'title'=>$this->product->title,
    //             'summary'=>$this->product->summary,
    //             'link'=>route('product-detail',$this->product->slug),
    //             'price'=>$this->product->price,
    //             'photo'=>$this->product->photo,
    //         );

    //         $price=$this->product->price;
    //         if($this->product->discount){
    //             $price=($price-($price*$this->product->discount)/100);
    //         }
    //         $current_item['price']=$price;

    //         $cart=session('cart') ? session('cart') : null;

    //         if($cart){
    //             // if anyone alreay order products
    //             $index=null;
    //             foreach($cart as $key=>$value){
    //                 if($value['id']==$this->product->id){
    //                     $index=$key;
    //                 break;
    //                 }
    //             }
    //             if($index!==null){
    //                 $cart[$index]['quantity']=$qty;
    //                 $cart[$index]['amount']=ceil($qty*$price);
    //                 if($cart[$index]['quantity']<=0){
    //                     unset($cart[$index]);
    //                 }
    //             }
    //             else{
    //                 $current_item['quantity']=$qty;
    //                 $current_item['amount']=ceil($qty*$price);
    //                 $cart[]=$current_item;
    //             }
    //         }
    //         else{
    //             $current_item['quantity']=$qty;
    //             $current_item['amount']=ceil($qty*$price);
    //             $cart[]=$current_item;
    //         }

    //         session()->put('cart',$cart);
    //         return response(['status'=>true,'msg'=>'Cart successfully updated','data'=>$cart]);
    //     }
    //     else{
    //         return response(['status'=>false,'msg'=>'You need to login first','data'=>null]);
    //     }
    // }

    // public function removeCart(Request $request){
    //     $index=$request->index;
    //     // return $index;
    //     $cart=session('cart');
    //     unset($cart[$index]);
    //     session()->put('cart',$cart);
    //     return redirect()->back()->with('success','Successfully remove item');
    // }

    public function checkout(Request $request)
    {
        // $cart=session('cart');
        // $cart_index=\Str::random(10);
        // $sub_total=0;
        // foreach($cart as $cart_item){
        //     $sub_total+=$cart_item['amount'];
        //     $data=array(
        //         'cart_id'=>$cart_index,
        //         'user_id'=>$request->user()->id,
        //         'product_id'=>$cart_item['id'],
        //         'quantity'=>$cart_item['quantity'],
        //         'amount'=>$cart_item['amount'],
        //         'status'=>'new',
        //         'price'=>$cart_item['price'],
        //     );

        //     $cart=new Cart();
        //     $cart->fill($data);
        //     $cart->save();
        // }
        return view('frontend.pages.checkout');
    }
}
