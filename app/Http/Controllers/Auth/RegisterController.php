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
            'civil_id_no' => ['required', 'string', 'min:9'],
            'reference_no' => ['string', 'min:9'],
            'civil_id_image' => ['image'],
            'personal_image' => ['image'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'mobile' => ['required', 'numeric'],
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
        $element = User::create([
            'name' => isset($data['first_name']) ? $data['first_name'] : null,
            'civil_id_no' => isset($data['civil_id_no']) ? $data['civil_id_no'] : null,
            'reference_no' => isset($data['reference_no']) ? $data['reference_no'] : null,
            'first_name' => isset($data['first_name']) ? $data['first_name'] : null,
            'father_name' => isset($data['father_name']) ? $data['father_name'] : null,
            'sur_name' => isset($data['sur_name']) ? $data['sur_name'] : null,
            'passport_no' => isset($data['passport_no']) ? $data['passport_no'] : null,
            'file_no' => isset($data['file_no']) ? $data['file_no'] : null,
            'city' => isset($data['city']) ? $data['city'] : null,
            'block' => isset($data['block']) ? $data['block'] : null,
            'street' => isset($data['street']) ? $data['street'] : null,
            'house_no' => isset($data['house_no']) ? $data['house_no'] : null,
            'is_officer' => isset($data['is_officer']) ? $data['is_officer'] : false,
            'email' => isset($data['email']) ? $data['email'] : null,
            'mobile' => isset($data['mobile']) ? $data['mobile'] : null,
            'nationality' => isset($data['nationality']) ? $data['nationality'] : null,
            'department' => isset($data['department']) ? $data['department'] : null,
            'section' => isset($data['section']) ? $data['section'] : null,
            'age' => isset($data['age']) ? $data['age'] : null,
            'password' => Hash::make($data['password']),
            'report_type_id' => ReportType::first()->id,
            'governate_id' => $data['governate_id'],
        ]);
        request()->hasFile('personal_image') ? $this->saveMimes($element, request(), ['personal_image'], ['1000', '1000'], true) : null;
        request()->hasFile('civil_id_image') ? $this->saveMimes($element, request(), ['civil_id_image'], ['1000', '1000'], true) : null;
        return $element;

    }
}
