<?php

namespace App\Http\Controllers;

use App\Models\ReportType;
use App\Services\Traits\ImageHelpers;
use Illuminate\Http\Request;

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

    public function changeLanguage()
    {
        app()->setLocale(request('locale'));
        session()->put('locale', request('locale'));
        return redirect()->back();
    }
}
