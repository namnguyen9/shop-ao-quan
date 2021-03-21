<?php

namespace App\Http\Controllers;

use App\Models\FavoriteProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;


class FavoriteProductController extends Controller
{
    //
    public function create($id){
        
        if(Auth::id()){

        $user_id = Auth::id();

        $check_product = FavoriteProduct::where('user_id',$user_id)->where('product_id',$id)->first();

            if($check_product){

                $statusCode['statusCode'] = 200;
        
                return response()->json($statusCode);

            }else{

                $data = [];

                $statusCode = [];
        
                $data['user_id'] = $user_id;
                $data['product_id'] = $id;
        
                FavoriteProduct::insert($data);
        
                $statusCode['statusCode'] = 201;
        
                return response()->json($statusCode);
            }
        }else{

            $statusCode['statusCode'] = 404;

             return response()->json($statusCode);
            
        }
    }

    public function getById(){

        if(Auth::id()){

        $user_id = Auth::id();

        $data = FavoriteProduct::where('user_id',$user_id)->get();

        foreach($data as $value){

            $value->product->photo_librarys;

        }

        $statusCode['statusCode'] = 200;

        $statusCode['data'] = $data;
    
        return response()->json($statusCode);

        }else{
    
            $statusCode['statusCode'] = 404;
    
            return response()->json($statusCode);
                
        }
    }

    public function delete($id){

        $object = FavoriteProduct::find($id);

        $object->delete();

    
        return response()->json(200);
    }

    public function delete_multiple(Request $request){

        foreach($request->list_id as $id){

            $object = FavoriteProduct::find($id);

            $object->delete();
        }

         return response()->json(200);

    }
}
