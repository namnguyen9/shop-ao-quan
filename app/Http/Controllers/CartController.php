<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Cart;


class CartController extends Controller
{

    public function index(){
        return view('pages.cart.show');
    }
    public function add_cart_ajax(Request $request){
    }

    public function save(Request $request){

        $productId = $request->id;
        $quantity = $request->qty;
        $product_info = Product::find($productId);
        $data['id'] = $product_info->id;
        $data ['qty'] = $quantity;
        $data ['name'] = $product_info->name;
        $data['price'] = $product_info->price;
        $data['weight'] = 300;
        $data ['options']['image'] = $product_info->photo_librarys[0]->name;
        $data ['options']['size'] = $product_info->size;
        Cart::add($data);
        $count = 0;
        foreach(Cart::content() as $value){
            $count += $value->qty;
        }
        $statusCode = [];

        $statusCode['data'] = Cart::content();
        $statusCode['count'] = $count;

       return response()->json($statusCode,200);
    }

    public function show(){
        
       $data = Cart::content();
       
       return response()->json($data,200);

    }

    public function show_total_cart(){
        
        $cart = [];
        $cart['subtotal'] =(float) str_replace(',', '',substr(Cart::subtotal(), 0, -3));
        $cart['tax'] =  0 ;
        $cart['total'] =(float) str_replace(',', '',substr(Cart::total(), 0, -3)) - (float) str_replace(',', '',substr(Cart::tax(), 0, -3)) ;
        $cart['content'] =Cart::content();
        return response()->json($cart,200);
 
     }
     
    
    public function delete($rowId){
        
        Cart::update($rowId,0);
        
        return response()->json(200);
    }
    
    public function cart_quantity_up(Request $request,$rowId)
    {
        if($request->qty < 200){

            $cart = Cart::update($rowId,$request->qty);

            return response()->json($cart,200);

        }
        return response()->json(100);
    }

      
    public function cart_quantity_down(Request $request,$rowId)
    {
        if($request->qty >= 1){

            $cart = Cart::update($rowId,$request->qty);

            return response()->json($cart,200);
        }
        return response()->json(100);
    }
    public function cart_update_qty(Request $request,$rowId){

        $cart = Cart::update($rowId,$request->qty);

        return response()->json($cart,200);
    }
}
