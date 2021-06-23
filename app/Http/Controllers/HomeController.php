<?php

namespace App\Http\Controllers;

use App\Models\ReportType;
use App\Models\User;
use App\Services\Traits\ImageHelpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    use ImageHelpers;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $elements = ReportType::active()->get();
        return view('home', compact('elements'));
    }

    public function getCheckCivilId()
    {
        return view('auth.login_civil_id');
    }

    public function postCheckCivilId(Request $request)
    {
//        dd($request->all());
        $validate = validator($request->all(), [
            'civil_id_no' => 'required|exists:users,civil_id_no',
            'passport_no' => 'required_if:is_officer,0|exists:users,passport_no',
            'police_no' => 'required_if:is_officer,1|exists:users,police_no',
            'password' => ['required', 'string', 'min:3'],
        ]);
        if ($validate->fails()) {
            return redirect()->back()->with(['error' => $validate->errors()->first()]);
        }
        if (auth()->attempt(['civil_id_no' => request()->civil_id_no, 'password' => request()->password])) {
            $element = User::where(['civil_id_no' => $request->civil_id_no])->first();
            auth()->login($element);
            return !$element->active ? redirect()->route('user.edit', $element->id) : redirect()->home();
        }
        return redirect()->back()->with(['error' => trans('general.process_failure')]);
    }

    public function changeLanguage()
    {
        app()->setLocale(request('locale'));
        session()->put('locale', request('locale'));
        return redirect()->back();
    }
}
