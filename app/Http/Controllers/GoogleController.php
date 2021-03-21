<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use Validator;
use Exception;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;



class GoogleController extends Controller
{

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function googleSignin()
    {

        try {
    
            $user = Socialite::driver('google')->user();

            $check_user = User::where('google_id', $user->getId())->first();

            if($check_user){

                Auth::login($check_user);
                return redirect()->route('trang-chu');

            }else{

                $user_id = User::insertGetId([
                    'name' => $user->getName(),
                    'email' => $user->getEmail(),
                    'facebook_id' => $user->getId(),
                    'avatar' => $user->getAvatar(),
                ]);
                
                Auth::loginUsingId($user_id,$remember = true);
                return redirect()->route('trang-chu');
            }
    
        } catch (Exception $exception) {
            dd($exception->getMessage());
        }
    }
}
