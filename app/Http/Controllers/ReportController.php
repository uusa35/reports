<?php

namespace App\Http\Controllers;

use App\Models\Governate;
use App\Models\Report;
use App\Models\ReportType;
use App\Models\ReportVehcile;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
            $elements = Report::active()->with(['owner', 'officer.speciality'])->orderBy('id', 'desc')->paginate(SELF::TAKE_MIN);
        } elseif ($auth->is_officer) {
            $elements = Report::active()->where(['officer_id' => $auth->id])->with(['owner', 'officer.speciality'])->orderBy('id', 'desc')->paginate(SELF::TAKE_MIN);
        } else {
            $elements = Report::active()->where(['user_id' => $auth->id])->with(['owner', 'officer.speciality'])->orderBy('id', 'desc')->paginate(SELF::TAKE_MIN);
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
        $validate = validator(request()->all(), [
            'report_type_id' => 'required|exists:report_types,id'
        ]);
        if ($validate->fails()) {
            return redirect()->home()->withErrors($validate->errors())->withInput();
        }
        $types = ReportType::active()->get();
        $currentType = ReportType::whereId(request()->report_type_id)->first();
        $governates = Governate::active()->get();
        return view('modules.report.create', compact('types', 'governates', 'currentType'));
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
//            'description' => 'required|max:1000',
//            'mobile' => 'required|numeric',
//            'address' => 'required|min:3',
            'image' => 'image',
//            'injuries_no' => 'required_if:has_injuries,1|numeric',
//            'report_type_id' => 'required|exists:report_types,id',
//            'vehicles' => 'array|required_if:is_traffic,1'
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
            $request->hasFile('image') ? $this->saveMimes($element, $request, ['image'], ['1080', '1440'], false) : null;
            $request->has('images') ? $this->saveGallery($element, $request, 'images', ['1080', '1440'], false) : null;
            $request->hasFile('path') ? $this->savePath($request, $element) : null;
            if ($element->report_type_id == 1) {
                return redirect()->route('add.vehicle', ['id' => $element->id])->with(['success' => trans('general.process_success')]);
            }
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
        $element = Report::whereId($id)->with('type','vehicles.user')->first();
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
        $element = Report::whereId($id)->with(['officer.speciality', 'owner'])->first();
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
//            'description' => 'required|max:1000',
//            'mobile' => 'required|numeric',
//            'address' => 'required|min:3',
            'image' => 'image',
//            'injuries_no' => 'required_if:has_injuries,1|numeric',
//            'report_type_id' => 'required|exists:report_types,id'
        ]);
        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate->errors())->withInput();
        }
        $request->request->add([
            'officer_id' => User::active()->where(['is_officer' => true])->get()->random()->id
        ]);
        $element = Report::whereId($id)->first();
        if ($element->update($request->except(['_token', 'image']))) {
            $request->hasFile('image') ? $this->saveMimes($element, $request, ['image'], ['1080', '1440'], false) : null;
            $request->has('images') ? $this->saveGallery($element, $request, 'images', ['1080', '1440'], false) : null;
            $request->hasFile('path') ? $this->savePath($request, $element) : null;
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

    public function getAddVehicle(Request $request)
    {
        $element = Report::whereId($request->id)->with('owner.vehicles')->first();
        return view('modules.report.add_vehicle', compact('element'));
    }

    public function postAddVehicle(Request $request)
    {
        $validate = validator($request->all(), [
//            'plate_no' => 'required',
//            'driver_license' => 'required',
            'report_id' => 'required'
        ]);
        if ($validate->fails()) {
            return redirect()->back()->with('error', $validate->errors()->first());
        }
        $report = Report::whereId($request->report_id)->with('owner.vehicles','vehicles')->first();
        $vehicle = Vehicle::where(['plate_no' => $request->plate_no])->first();
        $request->request->add(['vehicle_id' => $vehicle ? $vehicle->id : Vehicle::all()->random()->id]);
        $element = ReportVehcile::create($request->except('_token','image','images','path','plate_no'));
        $request->hasFile('image') ? $this->saveMimes($element, $request, ['image'], ['1080', '1440'], false) : null;
        $request->hasFile('path') ? $this->savePath($request, $element) : null;
        return redirect()->back()->with('success', trans('general.process_success'));
    }
}
