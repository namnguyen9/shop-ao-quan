<?php

namespace App\Http\Controllers;

use App\Models\FavoriteProduct;
use App\Models\User;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Shipping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class userController extends Controller
{
    //
  public  function index (){
      
    return view('admin.manage.user.index');

  }

  public function profile(){
    
    return view('pages.user.profile');

}

public function getData(){

  $data = User::all();

  return response()->json($data,200);

}

public function show(){

  $user_id = Auth::id();

  $user = User::find($user_id);

  return response()->json($user,200);

}


public function update(Request $request){

  $user_id =Auth::id();

  $data = [];
  $data['name'] = $request->name;
  $data['email'] =  $request->email;
  $data['phone'] =  $request->phone;
  $data['birthday'] =  $request->birthday;
  $data['gender'] =  $request->gender;

  DB::table('users')->update($data,$user_id);

  return response()->json(200);

}

public function update_password(Request $request){

    $old_password = $request->old_password;

    $new_password = $request->new_password;
  
    $user = Auth::user();

    if(Auth::attempt(['email' => $user->email, 'password' => $old_password],$remember = true)){

      $data['password'] = bcrypt($new_password);

      DB::table('users')->update($data,$user->id);

      return response()->json(true);

    }else{

      return response()->json(false);

    }
}


    public function delete_multiple(Request $request){

      foreach($request->list_id as $id){

      $user = User::find($id);

      $shippings = Shipping::where('user_id',$id)->get();

      $orders = Order::where('user_id',$user->id)->get();

      $favorite_products = FavoriteProduct::where('user_id',$id)->get();
        
      foreach($favorite_products  as $value){
          $value->delete();
      }

        foreach($orders as $order){

          $payments = Payment::where('id',$order->payment_id)->get();

            foreach($order->order_details as $order_detail){

              $order_detail->delete();

          }

            $order->delete();

            foreach($payments as $payment){

              $payment->delete();

          }

        }
          
        foreach($shippings as $shipping){

                  $shipping->delete();
        }

        $user->delete();

        }
        return response()->json(200);

    }
  public function delete($id){

      $user = User::find($id);

      $shippings = Shipping::where('user_id',$id)->get();

       
      $favorite_products = FavoriteProduct::where('user_id',$id)->get();
        
      foreach($favorite_products  as $value){
          $value->delete();
      }

      $orders = Order::where('user_id',$user->id)->get();

        foreach($orders as $order){

          $payments = Payment::where('id',$order->payment_id)->get();


            foreach($order->order_details as $order_detail){

              $order_detail->delete();

          }

          $order->delete();

          foreach($payments as $payment){

            $payment->delete();

        }

      }
        
      foreach($shippings as $shipping){

          $shipping->delete();

      }
      $user->delete();

     return response()->json(200);


  }
}
