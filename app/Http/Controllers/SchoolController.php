<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateSchoolRequest;
use App\Models\School;
use App\Services\JsonService;
use Illuminate\Http\Request;
use stdClass;

class SchoolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        $school = School::first();

        if (School::count() < 1) {
            $school = new stdClass;
            $school->school_name = "";
            $school->school_owner = "";
            $school->school_address = "";
            $school->school_phone = "";
            $school->school_logo = "";
            $school->school_year_price = 0;
        }
        return view("school.index", compact("school"));
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UpdateSchoolRequest $request)
    {

        $data = $request->validated();

        if (School::count() > 0)
            School::first()->update($data);
        else
            School::create($data);

        return JsonService::responseSuccess("تم الحفظ بنجاح", $data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\School  $school
     * @return \Illuminate\Http\Response
     */
    public function show(School $school)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\School  $school
     * @return \Illuminate\Http\Response
     */
    public function edit(School $school)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\School  $school
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSchoolRequest $request, School $school)
    {
        /*
        $data = $request->validated();

        $school->update($data);

        return JsonService::responseSuccess("تم الحفظ بنجاح", $data);
        */
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\School  $school
     * @return \Illuminate\Http\Response
     */
    public function destroy(School $school)
    {
        //
    }
}
