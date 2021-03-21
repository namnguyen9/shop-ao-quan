<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShippingRequest;
use App\Models\user;
use App\Models\Shipping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\ProvinceAndCity;
use Illuminate\Support\Facades\Auth;


class ShippingController extends Controller
{
    protected $data = [];
    
    public function create(ShippingRequest $request){

        $check_shipping = Shipping::all();

        $user_id = Auth::id();

        $check_for_existence = Shipping::where('name',$request->name)
                                        ->where('phone',$request->phone)
                                        ->where('user_id',$user_id)
                                        ->where('street_names',$request->street_names)
                                        ->where('wards_and_communes',$request->wards_and_communes)
                                        ->where('district_id',$request->district_id)
                                        ->where('province_and_city_id',$request->province_and_city_id)->first();
      
        if($check_for_existence){
            
            $this->data['statusCode'] = 202;
        
            return response()->json($this->data);

        }else{

            if(count($check_shipping) <= 5){
                $shipping = [];
                $shipping['name'] = $request->name;
                $shipping['phone']= $request->phone;
                $shipping['user_id'] = $user_id;
                $shipping['street_names'] = $request->street_names;
                $shipping['wards_and_communes'] = $request->wards_and_communes;
                $shipping['district_id'] = $request->district_id;
                $shipping['province_and_city_id'] = $request->province_and_city_id;
        
                $shipping_id = Shipping::insertGetId($shipping);
        
                if($shipping_id){
        
                    $this->data['shipping_id'] = $shipping_id;
                    $this->data['statusCode'] = 201;
        
                    return response()->json($this->data);
        
                }else{
                    $this->data['statusCode'] = 404;
        
                    return response()->json($this->data);
                }
            }else{
                $this->data['statusCode'] = 200;
        
                return response()->json($this->data);
            }
        }
    }

    public function get_byId (){
        $user_id = Auth::id();

        if($user_id){

            $shippings = Shipping::where('user_id',$user_id)->get();

            if(count($shippings) > 0){

                foreach($shippings as $value){
                    $value->province_and_city;
                    $value->district;
                }
                
                $this->data['shippings'] = $shippings;
                $this->data['shipping_id'] = $shippings[0]->id;
                $this->data['statusCode'] = 200;
                return response()->json($this->data);
            }else{

                $this->data['statusCode'] = 404;
                return response()->json($this->data);
            }
        }else{
            $this->data['statusCode'] = 404;

            return response()->json($this->data);
        }
    }

    public function update(ShippingRequest $request,$id){
        
        $old_shipping = Shipping::find($id);

        $user_id = Auth::id();

        if($old_shipping){
                
        $check_for_existence = Shipping::where('name',$request->name)
                                        ->where('phone',$request->phone)
                                        ->where('user_id',$user_id)
                                        ->where('street_names',$request->street_names)
                                        ->where('wards_and_communes',$request->wards_and_communes)
                                        ->where('district_id',$request->district_id)
                                        ->where('province_and_city_id',$request->province_and_city_id)
                                        ->whereNotIn('id',[$old_shipping->id])
                                        ->first();

            if($check_for_existence){

                $this->data['statusCode'] = 202;
                return response()->json($this->data);

            }else{

                $old_shipping->name = $request->name;
                $old_shipping->phone = $request->phone;
                $old_shipping->user_id = $user_id;
                $old_shipping->street_names =$request->street_names;
                $old_shipping->wards_and_communes = $request->wards_and_communes;
                $old_shipping->district_id = $request->district_id;
                $old_shipping->province_and_city_id = $request->province_and_city_id;
                $old_shipping->save();

                $this->data['statusCode'] = 200;
                return response()->json($this->data);
            }

         }else{
                
             $this->data['statusCode'] = 404;
            return response()->json($this->data);
        }
        
    }

    public function delete($id){


        $shipping = Shipping::find($id);

        if(!count($shipping->orders)){

            if($shipping){
            
                $shipping->delete();
                
                Session::forget('shipping_id');
    
                $this->data['statusCode'] = 200;
    
                return response()->json($this->data);
            }else{
                $this->data['statusCode'] = 404;
    
                return response()->json($this->data);
            }

        }else{
            
            $this->data['amount'] = count($shipping->orders);
    
            return response()->json($this->data);
        }
    }

    public function get_details($id){
        $shipping = Shipping::find($id);

        if($shipping){
            
            $this->data['statusCode'] = 200;
            $this->data['shipping'] = $shipping;

            return response()->json($this->data);
        }else{
            $this->data['statusCode'] = 404;

            return response()->json($this->data);
        }

    }

    public function provinces_and_cities() {
        $provinces_and_cities = ProvinceAndCity::all();
        foreach($provinces_and_cities as $value){
            $value->districts;
        }
        return response()->json($provinces_and_cities);
    }
}
