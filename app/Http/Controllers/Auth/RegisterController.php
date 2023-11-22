<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * 
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */

     protected function validator(array $data)
     {
        return Validator::make($data, [
        'name'=>['required','string','max:255'],
        'email'=>['required','string','max:255','unique:users'],
        'password'=>['required','string','min:6','confirmed'],
        ]);
     }

     protected function create(array $data)
     {
        $user = User::create([
            'name'=> $data['name'],
            'email'=> $data['email'],
            'password'=> Hash::make($data['password']),
            ]);

            $user->roles()->attach(2);
            
            return $user;
     }
}
