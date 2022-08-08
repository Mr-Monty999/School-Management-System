<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEmployeRequest;
use App\Http\Requests\UpdateEmployeRequest;
use App\Models\Employe;
use App\Models\User;
use App\Services\FileUploadService;
use App\Services\JsonService;
use App\Services\RegisterationService;
use Illuminate\Http\Request;

class EmployeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employe::latest()->paginate(5);
        return view("employees.index", compact('employees'));
    }

    public function table($pageNumber)
    {
        $employees = Employe::latest()->paginate(5, ['*'], 'page', $pageNumber);
        return view("employees.table", compact('employees'));
    }

    public function search($pageNumber, $name)
    {
        $employees = Employe::where("employe_name", "LIKE", "%$name%")->latest()->paginate(5, ['*'], 'page', $pageNumber);
        return view("employees.table", compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('employees.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEmployeRequest $request)
    {
        $data = $request->validated();
        $data["employe_photo"] = FileUploadService::handleImage($request->file("employe_photo"), "employe");
        $data["user_id"] = RegisterationService::createUserAcount("employe");

        $employe =  Employe::create($data);

        if ($request->give_admin == "on")
            $employe->user->assignRole("admin");
        else
            $employe->user->removeRole("admin");

        return  JsonService::responseSuccess("تم إضافة الموظف بنجاح", $data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employe  $employe
     * @return \Illuminate\Http\Response
     */
    public function show($id) // Use model binding
    {
        $employe = Employe::with('user')->findOrFail($id);
        return view("employees.show", compact("employe"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employe  $employe
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employe = Employe::findOrFail($id);
        return view("employees.edit", compact("employe"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employe  $employe
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEmployeRequest $request, $id)
    {

        $data = $request->validated();
        $employe = Employe::findOrFail($id);

        // Replace old image with uploaded one if any
        $data['employe_image'] = FileUploadService::updateImage($request->file('employe_photo'), $employe->employe_image, 'employe');

        $employe->update($data);


        if ($request->give_admin == "on")
            $employe->user->assignRole("admin");
        else
            $employe->user->removeRole("admin");

        return JsonService::responseSuccess("تم الحفظ بنجاح", $data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employe  $employe
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employe = Employe::find($id);
        $employe->user()->delete();
        $employe->delete();

        return  JsonService::responseSuccess("تم حذف الموظف بنجاح", $employe);
    }

    public function destroyAll(Request $request)
    {

        Employe::all()->each(function ($employe) {
            $employe->user()->delete();
        });
        Employe::whereNotNull("id")->delete();

        return JsonService::responseSuccess("تم حذف جميع الموظفين بنجاح", null);
    }
}
