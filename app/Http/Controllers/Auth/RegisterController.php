<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/admin/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'access_level' => 'required|string|max:255',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        if($data['access_level'] == "Registrar")
        {
            $accessLevel = 1;
            return User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'access_level' => $accessLevel,
                'password' => Hash::make($data['password']),
            ]);
        }
        else if($data['access_level'] == "Program Head")
        {
            $accessLevel = 2;
            return User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'access_level' => $accessLevel,
                'password' => Hash::make($data['password']),
            ]);
        }
        else if($data['access_level'] == "Teacher")
        {
            $accessLevel = 3;
            return User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'access_level' => $accessLevel,
                'password' => Hash::make($data['password']),
            ]);
        }

    }
}
