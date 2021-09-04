<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Governate;
use App\Models\Report;
use App\Models\ReportType;
use App\Models\ReportVehcile;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PublicReportController extends Controller
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
        if ($currentType->id === 2) { // accident with injury
            return view('modules.report.public.create_accident_with_injury', compact('types', 'governates', 'currentType'));
        }
        if ($currentType->id === 3) { // calling ambulance
            return view('modules.report.public.create_calling_ambullance', compact('types', 'governates', 'currentType'));
        }
        if ($currentType->id === 4) { // report fire accident
            return view('modules.report.public.create_fire_with_accident', compact('types', 'governates', 'currentType'));
        }
        if ($currentType->id === 5) { // report damage
            return view('modules.report.public.create_property_damage', compact('types', 'governates', 'currentType'));
        }
        if ($currentType->id === 6) { // report violation
            return view('modules.report.public.create_traffic_violation', compact('types', 'governates', 'currentType'));
        }
        // minor accident
        return view('modules.report.public.create', compact('types', 'governates', 'currentType'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        dd($request->all());
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
        if (request()->has("report_type_id")) {
            $reportType = ReportType::whereId(request()->report_type_id)->first();
            if ($reportType->is_traffic) { // Accedient Insepection
                $responsibleOfficer = User::where(['is_officer' => true, 'department_id' => Department::where(['is_traffic' => true])->first()->id])->first();
            } elseif ($reportType->is_ambulance) { // Medical Emergency
                $responsibleOfficer = User::where(['is_officer' => true, 'department_id' => Department::where(['is_medical' => true])->first()->id])->first();
            } elseif ($reportType->is_fire) {
                $responsibleOfficer = User::where(['is_officer' => true, 'department_id' => Department::where(['is_fire' => true])->first()->id])->first();
            } elseif ($reportType->is_damage) { // damage
                $responsibleOfficer = User::where(['is_officer' => true, 'department_id' => Department::where(['is_engineering' => true])->first()->id])->first();
            }
        }
        $responsibleOfficer = $responsibleOfficer ? $responsibleOfficer : User::where(['is_officer' => true])->first();
        $request->request->add([
            'reference_id' => rand(9999, 99999999),
            'officer_id' => !request()->has('officer_id') ? $responsibleOfficer->id : request()->officer_id,
            'department_id' => $responsibleOfficer->department_id
        ]);
        $element = Report::create($request->except(['_token', 'image']));
        if ($element) {
            $request->hasFile('image') ? $this->saveMimes($element, $request, ['image'], ['1080', '1440'], false) : null;
            $request->has('images') ? $this->saveGallery($element, $request, 'images', ['1080', '1440'], false) : null;
            $request->hasFile('path') ? $this->savePath($request, $element) : null;
            if ($element->report_type_id == 1 || $element->report_type_id == 2 ||  $element->report_type_id == 4 || $element->report_type_id == 6) {
                return redirect()->route('public.add.vehicle', ['id' => $element->id])->with(['success' => trans('general.process_success')]);
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

        $element = Report::whereId($id)->with('type', 'vehicles.user')->first();
        if ($element->report_type_id == 2) {
            return view('modules.report.public.show_with_injury', compact('element'));
        }
        if ($element->report_type_id == 3) {
            return view('modules.report.public.show_calling_ambulance', compact('element'));
        }
        if ($element->report_type_id == 4) {
            return view('modules.report.public.show_fire_with_accident', compact('element'));
        }
        if ($element->report_type_id == 6) {
            return view('modules.report.public.show_traffic_violation', compact('element'));
        }
        return view('modules.report.public.show', compact('element'));
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
        $report = Report::whereId($id)->first();
        $report->vehicles()->sync([]);
        if ($report->delete()) {
            return redirect()->home()->with('success', 'report delete');
        }
        return redirect()->home()->with('error', 'report not delete');
    }

    public function getAddVehicle(Request $request)
    {
//        dd($request->all());
        $element = Report::whereId($request->id)->with('owner.vehicles')->first();
        if ($element->report_type_id == 2) {
            return view('modules.report.public.create_accident_with_injury_add_vehicle', compact('element'));
        }
        if ($element->report_type_id === 3) {
            return view('modules.report.public.create_calling_ambullance_add_injuiry', compact('element'));
        }
        if ($element->report_type_id === 4) {
            return view('modules.report.public.create_fire_add_vehicle_or_injury', compact('element'));
        }
        if ($element->report_type_id === 6) {
            return view('modules.report.public.create_traffic_violation_add_vehicle', compact('element'));
        }
        return view('modules.report.public.add_vehicle', compact('element'));
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
        $report = Report::whereId($request->report_id)->with('owner.vehicles', 'vehicles')->first();
        $vehicle = Vehicle::firstOrCreate(['plate_no' => $request->plate_no, 'user_id' => User::where('is_officer',false)->get()->random()->first()->id]);
        $request->request->add(['vehicle_id' => $vehicle->id]);
        $element = ReportVehcile::create($request->except('_token', 'image', 'images', 'path', 'plate_no'));
        $request->hasFile('image') ? $this->saveMimes($element, $request, ['image'], ['1080', '1440'], false) : null;
        $request->hasFile('path') ? $this->savePath($request, $element) : null;
        if ($element->report->type->id === 4) {
            return redirect()->route('home')->with('success', trans('general.process_success'));
        }
        if ($element->report->type->id === 6) {
            return redirect()->route('home')->with('success', trans('general.process_success'));
        }
        return redirect()->back()->with('success', trans('general.process_success'));
    }
}
