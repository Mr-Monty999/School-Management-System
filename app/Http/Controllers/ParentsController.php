<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateParentRequest;
use App\Models\Parents;
use App\Services\JsonService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ParentsController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:student.view',['only' => 'index','show' , 'table']);
        $this->middleware('permission:student.edit',['only' => 'edit','update']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $parents = Parents::withCount('students')->orderBy("id", "desc")->paginate(10);
        return view("parents.index", compact('parents'));
    }

    public function table($pageNumber, $sortBy, $name = "")
    {

        $name = trim($name);
        $parents = null;
        if ($sortBy == "last") {
            $parents = Parents::withCount('students')
                ->where("parent_name", 'LIKE', "%$name%")
                ->orderBy("id", "desc")
                ->paginate(10, ['*'], 'page', $pageNumber)
                ->withPath(route('parents.index'));
        } elseif ($sortBy == "first") {
            $parents = Parents::withCount('students')
                ->where("parent_name", 'LIKE', "%$name%")
                ->orderBy("id")
                ->paginate(10, ['*'], 'page', $pageNumber)
                ->withPath(route('parents.index'));
        } else {
            $parents = Parents::withCount('students')
                ->where("parent_name", 'LIKE', "%$name%")
                ->orderBy("parent_name")
                ->paginate(10, ['*'], 'page', $pageNumber)
                ->withPath(route('parents.index'));
        }

        return view("parents.table", compact('parents'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Parents  $parents
     * @return \Illuminate\Http\Response
     */
    public function show(Parents $parent)
    {
        $parent->load('students', 'students.class');


        return view('parents.show', compact('parent'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Parents  $parents
     * @return \Illuminate\Http\Response
     */
    public function edit(Parents $parent)
    {
        // return $parent;
        return view('parents.edit', compact("parent"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Parents  $parents
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateParentRequest $request, Parents $parent)
    {
        $data = $request->validated();

        $parent->update($data);

        return  JsonService::responseSuccess('تم حفظ البيانات بنجاح', $data);
    }

}
