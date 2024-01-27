<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BusinessPermit;
use App\Models\Resident;

class BusinessPermitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $business = BusinessPermit::with('resident')->get();
        return view('admin.business.index', compact('business'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $residents = Resident::with('business')->get();
        return view('admin.business.create', compact('residents'));
        
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
            'residentID' => 'required|unique:business_permits,residentID',
            'businessName' => 'required|min:2',
            'businessAddress' => 'required|min:5',
        ]);

        BusinessPermit::create([
            'residentID' => $request->residentID,
            'businessName' => $request->businessName,
            'businessAddress' => $request->businessAddress,
        ]);

        return redirect()->route('business_permits.index')->with('success', 'Succesfully saved.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BusinessPermit  $businessPermit
     * @return \Illuminate\Http\Response
     */
    public function show(BusinessPermit $businessPermit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BusinessPermit  $businessPermit
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $business = BusinessPermit::find($id);
        $businessOwner = BusinessPermit::with('resident')->get();
        return view('admin.business.edit', compact('business', 'businessOwner'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BusinessPermit  $businessPermit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'residentID' => 'required|unique:business_permits,residentID,' .$id,
            'businessName' => 'required|min:2',
            'businessAddress' => 'required|min:5',
        ]);

        $update = BusinessPermit::find($id);
        $update->residentID = $request->residentID;
        $update->businessName = $request->businessName;
        $update->businessAddress = $request->businessAddress;
        $update->save();

        return redirect()->route('business_permits.index')->with('info', 'Succesfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BusinessPermit  $businessPermit
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $update = BusinessPermit::findorFail($id);
        $update->delete();
        return redirect()->route('business_permits.index')->with('danger', 'Succesfully deleted.');
    }
}
