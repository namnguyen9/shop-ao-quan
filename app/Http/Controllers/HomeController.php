<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Brand;
use App\Models\District;
use App\Models\Product;
use Illuminate\Http\Request;



class HomeController extends Controller
{
    public function index(Request $request){
        
        $meta_title = "Trang chủ | E-Shopper";
        $meta_desc = "shop bán hàng chất lượng cao";
        $meta_keywords ="Quần áo Bape,Adidas,Nike,Gucci";
        $image_og = asset('frontend/images/shop.PNG');
        $url_canonical = $request->url();

        return view('pages.home',compact(['meta_title','meta_desc','meta_keywords','url_canonical','image_og']));
    }

    public function json_data(){

        $products = Product::where('status',1)->orderby('id','desc')->limit(6)->get();
        foreach($products as $product){
            
         $product->photo_librarys;

        }
        return response()->json($products,200);
    }

    public function search(Request $request){
        
        $data = Product::where('name', 'like', '%' . $request->key . '%')->get();
        foreach($data as $product){
            $product->photo_librarys;
        }
        return response()->json($data);
    }

}
