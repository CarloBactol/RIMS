<?php

namespace App\Http\Controllers;

use App\Models\Resident;
use Illuminate\Http\Request;

class BlotterPersonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.bperson.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'firstName' => "required|min:2|max:10|string",
            'lastName' => "required|min:2|max:10|string",
            'gender' => "required",
            'address' => "required",
            'nationality' => "required",
            'barangay' => "required",
        ]);

        $resident = new Resident();
        $resident->firstName = $request->get('firstName');
        $resident->lastName = $request->get('lastName');
        $resident->gender = $request->get('gender');
        $resident->address = $request->get('address');
        $resident->nationality = $request->get('nationality');
        $resident->barangay = $request->get('barangay');
        $resident->status = $request->status == '' ? 0 : 1;
        $resident->isBlotter = true;
        $resident->save();

        return redirect()->route('blotters.index')->with('success', 'Successfully saved.');
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
