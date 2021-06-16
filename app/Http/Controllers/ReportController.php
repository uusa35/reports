<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\ReportType;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $auth = auth()->user();
        if ($auth->is_admin) {
            $elements = Report::active()->with(['owner', 'officer.speciality'])->orderBy('id','desc')->paginate(SELF::TAKE_MIN);
        } elseif ($auth->is_officer) {
            $elements = Report::active()->where(['officer_id' => $auth->id])->with(['owner', 'officer.speciality'])->orderBy('id','desc')->paginate(SELF::TAKE_MIN);
        } else {
            $elements = Report::active()->where(['user_id' => $auth->id])->with(['owner', 'officer.speciality'])->orderBy('id','desc')->paginate(SELF::TAKE_MIN);
        }
        return view('modules.report.index', compact('elements'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = ReportType::active()->get();
        return view('modules.report.create', compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = validator(request()->all(), [
            'description' => 'required|max:1000',
            'mobile' => 'required|numeric',
            'address' => 'required|min:3',
            'image' => 'image',
            'image_two' => 'image',
            'injuries_no' => 'required_if:has_injuries,1|numeric',
            'report_type_id' => 'required|exists:report_types,id'
        ]);
        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate->errors())->withInput();
        }
        $request->request->add([
            'reference_id' => rand(9999, 99999999),
            'user_id' => auth()->user()->id,
            'officer_id' => User::where('is_admin', true)->first()->id
        ]);
        $element = Report::create($request->except(['_token', 'image']));
        if ($element) {
            $request->hasFile('image') ? $this->saveMimes($element, $request, ['image'], ['1080', '1440'], true) : null;
            $request->hasFile('image_two') ? $this->saveMimes($element, $request, ['image_two'], ['1080', '1440'], true) : null;
            return redirect()->home()->with(['success' => trans('general.process_success')]);
        }
        return redirect()->back()->with(['error' => trans('general.process_failure')]);

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $element = Report::whereId($id)->with('type')->first();
        return view('modules.report.show', compact('element'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $element = Report::whereId($id)->with(['officer.speciality','owner'])->first();
        $types = ReportType::active()->get();
        return view('modules.report.edit', compact('element', 'types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validate = validator(request()->all(), [
            'description' => 'required|max:1000',
            'mobile' => 'required|numeric',
            'address' => 'required|min:3',
            'image' => 'image',
            'image_two' => 'image',
            'injuries_no' => 'required_if:has_injuries,1|numeric',
            'report_type_id' => 'required|exists:report_types,id'
        ]);
        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate->errors())->withInput();
        }
        $request->request->add([
            'officer_id' => User::active()->where(['is_officer' => true , 'report_type_id' => $request->report_type_id])->get()->random()->id
        ]);
        $element = Report::whereId($id)->first();
        if ($element->update($request->except(['_token', 'image']))) {
            $request->hasFile('image') ? $this->saveMimes($element, $request, ['image'], ['1080', '1440'], true) : null;
            $request->hasFile('image_two') ? $this->saveMimes($element, $request, ['image_two'], ['1080', '1440'], true) : null;
            return redirect()->route('report.index')->with(['success' => trans('general.process_success')]);
        }
        return redirect()->back()->with(['error' => trans('general.process_failure')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}