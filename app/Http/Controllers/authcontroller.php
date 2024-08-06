<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;


use Hash;

class authcontroller extends Controller
{


    public function index(){
        return view('posts.index');
    }
    public function register(){
        return view('users.register');
    }

    public function handelregister(Request $request)   {
        $request->validate([
            'name'=>'required|string|max:100',
            'email'=>'required|string|max:200|email',
            'password'=>'required|string|max:255',


        ]);

        $name=$request->name;
        $email=$request->email;
        $password=$request->password;

       $user= User::create([
            'name'=>$name,
            'email'=>$email,
            'password'=>Hash::make($password),
            'access_token' => Hash::make(Str::random(40))
        
        ]);

        Auth::login($user);

        return redirect(route('posts.index'));

    }

   

    public function login(){
        return view('users.login');
    }

    public function handellogin(Request $request){
        $request->validate([
            'email'=>'required|string|max:200|email',
            'password'=>'required|string|max:255',


        ]);

        $email=$request->email;
        $password=$request->password;

        $cord=$request->only('email','password');

        if(Auth::attempt($cord)){
            return redirect(route('posts.index'));

        }else{
            return back()->with('error', 'You don’t have an account.');
        }
    }

    public function logout(){
        Auth::logout();
        return view('users.login');
    }

    public function redirect(){
        return Socialite::driver('github')->redirect();

    }
    
    public function callback(){
        $user = Socialite::driver('github')->user();
       //dd($user);
        $email=$user->email;
        $dduser=User::where('email','=',$email)->first();
        if($dduser){
            Auth::login($dduser);

        }else{
            $adsr=User::create([
                'name'=>$user->name,
                'email'=>$user->email,
                'password'=>Hash::make('asdsad'),
                'Oauth_token'=>$user->token
            ]);
            Auth::login($adsr);
        }
        
        return redirect(route('posts.index'));
    }



    public function redirectgoog(){
        return Socialite::driver('google')->redirect();

    }
    
    public function callbackgoog(){
        $user = Socialite::driver('google')->user();
       // dd($user);
        $email=$user->email;
        $dduser=User::where('email','=',$email)->first();
        if($dduser){
            Auth::login($dduser);

        }else{
            $adsr=User::create([
                'name'=>$user->name,
                'email'=>$user->email,
                'password'=>Hash::make('asdsadss'),
                'Oauth_token'=>$user->token
            ]);
            Auth::login($adsr);
        }
        
        return redirect(route('posts.index'));
    }

    public function getnameuser($id){
        // Find the user by ID
        $user = User::findOrFail($id);
    
        // Retrieve posts by the user
        $posts = Post::where('user_id', $id)->get();
    
        // Return the view with both user and posts data
        return view('posts.index', [
            'user' => $user,
            'posts' => $posts
        ]);
    }
    
}
