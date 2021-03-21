<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

use App\Models\User;
use Validator;
use Exception;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;


class FacebookController extends Controller
{
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function facebookSignin()
    {

        try {
    
            $user = Socialite::driver('facebook')->user();

            $facebookId = User::where('facebook_id', $user->getId())->first();

            if($facebookId){

                Auth::login($facebookId,$remember = true);
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
