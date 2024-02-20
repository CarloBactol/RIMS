<?php

namespace App\Http\Controllers;

use App\Models\Resident;
use Illuminate\Http\Request;

class CreateBlotter extends Controller
{
    public function create()
    {
        return view('admin.bperson.create');
    }
    
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

}
