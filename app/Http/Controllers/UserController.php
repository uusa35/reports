<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $element = auth()->user();
        return view('modules.user.edit', compact('element'));
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
            'mobile' => 'required|numeric',
            'civil_id_no' => 'required|numeric',
            'address' => 'required|min:3',
            'civil_id_image' => 'image',
            'personal_image' => 'image',
        ]);
        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate->errors())->withInput();
        }
        $element = User::whereId($id)->first();
        if ($element->update($request->request->all())) {
            $request->hasFile('civil_id_image') ? $this->saveMimes($element, $request, ['civil_id_image'], ['1080', '1440'], true) : null;
            $request->hasFile('personal_image') ? $this->saveMimes($element, $request, ['personal_image'], ['1080', '1440'], true) : null;
            return redirect()->route('report.index')->with(['success' => trans('general.process_success')]);
        }
        return redirect()->home()->with(['error' => trans('general.process_failure')]);
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
