<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function redirect(){
        // return Socialite::driver('google')->with(['prompt'=>"select"])->redirect();
        return Socialite::driver('google')->redirect();

    }
    public function callback(){
        $userGoogle = Socialite::driver('google')->user();

        // $email = $userGoogle->email;


        // $currentUser = User::where('email',$email)->first();
        // if(is_null($currentUser)){
        //     $userGoogle=User::create([
        //         'email' => $email,
        //         'name' => $userGoogle->name,
        //         'role' => 0,
        //         'password' => Hash::make('email'.'@'.$userGoogle->id),
        //         'google_user_id' => $userGoogle->id
        //     ]);
        // }

        $currentUser = User::updateOrCreate([
            'email' => $userGoogle->email,
        ],[
            'email'=>$userGoogle->email,
            'name'=>$userGoogle->name,
            'google_user_id'=>$userGoogle->id,
            'password' => Hash::make('email'.'@'.$userGoogle->id),
        ]);

        Auth::login($currentUser);
        // dd($userGoogle);
        return redirect()->route('shifts.index');

    }
}
