<?php

namespace App\Http\Controllers;

use App\Http\Requests\SignupFormRequest;
use App\Models\Admin;
use Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Payment;
use App\Models\Shipping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CheckoutController extends Controller
{   
    protected $data = [];

    public function index(){
        return view('pages.checkout.payment');
    }

    public function user_login(){
        return view('pages.checkout.login_checkout');
    }

    
    public function sign_up(){
        return view('pages.checkout.sign_up');
    }

    
    public function hand_cash(){
        return view('pages.checkout.hand_cash');

    }

    public function online_payment(){
        return view('pages.checkout.online_payment');

    }


    public function new_user_signup(SignupFormRequest $request){
        $new_user=[];
        $new_user['name'] = $request->name;
        $new_user['email'] = $request->email;
        $new_user['password'] = bcrypt($request->password);
        $new_user['phone'] = $request->phone;
        $user_id = User::insertGetId($new_user);

        if(Auth::loginUsingId($user_id,$remember = true)){

            $request->session()->regenerate();

           $this->data['statusCode'] = 200;
            return response()->json($this->data);
        }else{
            $data['statusCode'] = 404;
            return response()->json($this->data);
        }
    }

    public function login(Request $request){

        $email = $request->email;
        $password = $request->password;

        $admin = Admin::where('email',$email)->first();

        if($admin){

            if (Hash::check($password, $admin->password)) {
                
                $request->session()->regenerate();

                Session::put('admin',$admin);
                Session::put('admin_id',$admin->id);

                $this->data['statusCode'] = 201;
                return response()->json($this->data);
            }else{
                $this->data['statusCode'] = 404;
                return response()->json($this->data);
            }
        }else{

                $credentials = [
                'email' => $email,
                'password' => $password
            ];

            if (Auth::attempt($credentials,$remember = true)) {

                $request->session()->regenerate();

                $user = Auth::user();

                if(count($user->shippings) > 0){

                    Session::put('shipping_id',$user->shippings[0]->id);

                    $this->data['statusCode'] = 200;
                    return response()->json($this->data);
                }else{

                    $this->data['statusCode'] = 200;
                    return response()->json($this->data);

                }
            }else{

                $this->data['statusCode'] = 404;
                return response()->json($this->data);

            }

        }        
          
    }
    
    public function logout(Request $request){

        Auth::logout();

        $request->session()->invalidate();

        $this->data['statusCode'] = 200;
        
        return response()->json($this->data);
    }

    public function order_place(Request $request){
        $data_cart = Cart::content();
        $payment = [];
        $order_data = [];
        $order_details = [];
        $payment['method'] =$request->payment_method;
        $payment['status'] ="đang chờ xử lý";
        $payment_id = Payment::insertGetId($payment);

        $order_data['user_id'] = Auth::id();
        $order_data['shipping_id'] = $request->shipping_id;
        $order_data['payment_id'] = $payment_id ;
        $order_data['total'] = (int) str_replace(',', '',substr(Cart::total(), 0, -3)) - (int) str_replace(',', '',substr(Cart::tax(), 0, -3)) ;
        $order_data['status'] ="đang chờ xử lý";
        $order_data['note'] =$request->note;
        $order_id = Order::insertGetId($order_data);

        foreach($data_cart as $value){
            $order_details['order_id'] = $order_id;
            $order_details['product_id'] = $value->id;
            $order_details['product_sales_quantity'] = $value->qty;
            OrderDetails::insert($order_details);
            }

        Cart::destroy();
        $this->data['payment_method'] = $request->payment_method;
        $this->data['statusCode'] = 200;
         return response()->json($this->data);

    }


}
