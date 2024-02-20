<?php

namespace App\Http\Controllers;

use App\Models\People;
use Illuminate\Http\Request;

class PeopleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $people = People::orderBy('lastName', 'desc')->get();
        return view('admin.people.index', compact("people"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.people.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, People $people)
    {
        $this->validate($request, ["firstName" => "required|string|min:2|max:20",
                                                "middleName" => "required|string|min:2|max:20", 
                                                "lastName" => "required|string|min:2|max:20",
                                                "address" => "required|string|min:5|max:100"]);
        $people->create($request->all());
        return redirect()->route("people.index")->with("success", "Person Created Successfully!");                                                     
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $people = People::find($id);
        return view('admin.people.edit', compact("people"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, ["firstName" => "required|string|min:2|max:20",
                                                "middleName" => "required|string|min:2|max:20", 
                                                "lastName" => "required|string|min:2|max:20",
                                                "address" => "required|string|min:5|max:100"]);
         $people = People::find($id);
         $people->update($request->all());      
         return redirect()->route("people.index")->with("info", "Person Updated Successfully!");                                  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = People::findorFail($id);
        $delete->delete();
        return redirect()->back()->with('danger', 'Person Deleted Successfully!');
    }
}
