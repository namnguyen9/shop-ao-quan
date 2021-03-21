<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Payment;
use Illuminate\Http\Request;
use App\Services\OrderService;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    
    protected $order_service;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(OrderService $order_service)
    {
        $this->order_service = $order_service;
    }

    public function getData()
     {
         $orders = $this->order_service->getAll();

         foreach($orders as $order){
             $order->user;
             $order->shipping->district;
             $order->shipping->province_and_city;
             $order->payment;
         }
 
         return response()->json($orders, 200);
     }
 
    public function index()
    {
        return view('admin.manage.order.index');
    }

    public function get_order_byId(){

        $user_id = Auth::id();

        $orders = Order::where('user_id',$user_id)->get();
        
        foreach($orders as $order){

            foreach($order->order_details as $order_detail){

                $order_detail->product->photo_librarys;
            }
        }

        return response()->json($orders, 200);
               
    }

    public function view_order($id)
    {
        $order = $this->order_service->findById($id);
        $order->user;
        $order->shipping->district;
        $order->shipping->province_and_city;
        foreach( $order->order_details as $value){
            $value->product;
        }
        return response()->json($order, 200);
    }

    public function destroy($id)
    {
        $object = $this->order_service->findById($id);

        if($object){

            $payment = Payment::find($object->payment_id);

            foreach($object->order_details as $order_detail){
                $order_detail->delete();
            }
            $object->delete();

            $payment->delete();
            
            return response()->json(200);

        }else{
            return response()->json($object['statusCode']);
        }
    }

    public function delete_multiple_order(Request $request){

        foreach($request->list_id as $id){

            $object = $this->order_service->findById($id);

            if($object){
    
                $payment = Payment::find($object->payment_id);
    
                foreach($object->order_details as $order_detail){

                    $order_detail->delete();

                }
                $object->delete();
    
                $payment->delete();
                
            }
        }
        
        return response()->json($object['statusCode']);

    }

    public function delete_order_details($id){

        $order_detail = OrderDetails::find($id);

        $order_detail_price = $order_detail->product->price * $order_detail->product_sales_quantity;

        $order = Order::where('id',$order_detail->order_id)->first();

        $order_detail->delete();

        if(count($order->order_details) > 0){

            $data = [];

            $data['total'] = $order->total - $order_detail_price;

            DB::table('orders')->update($data,$order->id);

            return response()->json(200);

        }else{

            $payment = Payment::find($order->payment_id);

            $order->delete();

            $payment->delete();

            return response()->json(201);
            
        }
    }

    public function delete_multiple(Request $request){

        foreach($request->list_id as $id){
            
            $order_detail = OrderDetails::find($id);

            $order_detail_price = $order_detail->product->price * $order_detail->product_sales_quantity;
    
            $order = Order::where('id',$order_detail->order_id)->first();
    
            $order_detail->delete();
    
            if(count($order->order_details) > 0){
    
                $data = [];
    
                $data['total'] = $order->total - $order_detail_price;
    
                DB::table('orders')->update($data,$order->id);
    
            }else{
    
                $payment = Payment::find($order->payment_id);
    
                $order->delete();
    
                $payment->delete();
    
                return response()->json(201);
                
            }
          
        }
            
        }

}
