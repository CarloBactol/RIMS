<?php

namespace App\Http\Controllers;

use App\Models\Resident;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    // public function index()
    // {
    //     return view('admin.resident.index');
    // }

    // public function search(Request $request)
    // {
    //     $query = $request->input('query');
    //     // $residents = Resident::where('lastName', 'LIKE', "%$query%")->get();
    //     $residents = Resident::all();
    //     $residents->contains(function ($name, $key, $query) {
    //         return $name->lastName == $query;
    //     });

    //     return response()->json($residents);
    //     // return view('admin.resident.index', compact('residents'));
    // }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $residents = Resident::all();

        $filteredResidents = $residents->filter(function ($resident) use ($query) {
            return stripos($resident->lastName, $query) !== false;
        });

        return response()->json($filteredResidents);
    }



    public function delete($id)
    {
        $delete = Resident::findOrFail($id);
        $delete->delete();
        return redirect()->route('residents.index')->with('danger', 'Successfully deleted.');
    }
}
