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

    public function search(Request $request)
    {
        $query = $request->input('query');
        $residents = Resident::where('lastName', 'LIKE', "%$query%")->get();

        return response()->json($residents);
        // return view('admin.resident.index', compact('residents'));
    }


    public function delete($id)
    {
        $delete = Resident::findOrFail($id);
        $delete->delete();
        return redirect()->route('residents.index')->with('danger', 'Successfully deleted.');
    }
}
