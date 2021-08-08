<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\ReportType;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Services\Traits\ImageHelpers;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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

    use RegistersUsers, ImageHelpers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

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
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => ['required', 'string', 'max:255'],
//            'civil_id_no' => ['required', 'numeric', 'min:12'],
//            'reference_no' => ['numeric', 'min:9'],
            'personal_image' => ['image'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
//            'mobile' => ['required', 'numeric'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        request()->request->add(['password' => Hash::make($data['password'])]);
        $element = User::create(request()->request->all());
        request()->hasFile('personal_image') ? $this->saveMimes($element, request(), ['personal_image'], ['1000', '1000'], true) : null;
        request()->hasFile('civil_id_image') ? $this->saveMimes($element, request(), ['civil_id_image'], ['1000', '1000'], true) : null;
        return $element;

    }
}
