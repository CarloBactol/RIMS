<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BlotterRecord;
use App\Models\Resident;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class BlotterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blotter = BlotterRecord::with('officer')->get();
        return view('admin.blotter.index', compact('blotter'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $resident = Resident::all();
        return view('admin.blotter.create', compact('resident'));
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
            'residentID' => "required",
            'description' => "required|min:10|max:200",
        ]);

        $bRecord = new BlotterRecord();
        $bRecord->residentID = $request->get('residentID');
        $bRecord->description = $request->get('description');
        $bRecord->date = Carbon::now();
        $bRecord->officerID = Auth::user()->id;
        $bRecord->save();
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
        $blotter = BlotterRecord::findOrFail($id);
        $resident = Resident::all();
        return view('admin.blotter.edit', compact('resident', 'blotter'));
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
        $this->validate($request, [
            // 'residentID' => "required",
            'description' => "required|min:10|max:200",
        ]);

        $bRecord = BlotterRecord::findOrFail($id);
        $bRecord->description = $request->get('description');
        $bRecord->date = Carbon::now();
        $bRecord->officerID = Auth::user()->id;
        $bRecord->save();
        return redirect()->route('blotters.index')->with('info', 'Successfully update.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $bRecord = BlotterRecord::findOrFail($id);
        $bRecord->delete();
        return redirect()->route('blotters.index')->with("danger", "Blotter deleted successfully.");
    }
}
