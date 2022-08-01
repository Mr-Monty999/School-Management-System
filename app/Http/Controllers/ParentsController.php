<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateParentRequest;
use App\Models\Parents;
use App\Services\JsonService;
use Illuminate\Http\Request;

class ParentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $parents = Parents::with('students')->latest()->paginate(10);

        return view("parents.index", compact('parents'));
    }

    public function table($pageNumber)
    {
        $parents = Parents::with('students')->latest()->paginate(10, ['*'], 'page', $pageNumber)->withPath(route('parents.index'));
        return view("parents.table", compact('parents'));
    }

    public function search($pageNumber, $name)
    {
        $parents = Parents::where("parent_name", 'LIKE', "%$name%")->latest()->paginate(10, ['*'], 'page', $pageNumber)->withPath(route('parents.index'));
        return view("parents.table", compact('parents'));
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
    public function store(Request $request)
    {
        //
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Parents  $parents
     * @return \Illuminate\Http\Response
     */
    public function destroy(Parents $parents)
    {
        //
    }
}
