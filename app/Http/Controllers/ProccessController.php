<?php

namespace App\Http\Controllers;

use App\Models\Resident;
use Illuminate\Http\Request;

class ProccessController extends Controller
{

    public function index(Request $request)
    {
        $query = $request->input('query');

        $results = Resident::where('firstName', 'like', '%' . $query . '%')
            ->orWhere('lastName', 'like', '%' . $query . '%')
            ->limit(5)
            ->get();

        return response()->json($results);
    }


    public function processData(Request $request)
    {
        // Handle and process the data received from the frontend
        $data = $request->input('ownerName');

        // Return a response if needed
        return response()->json(['message' => 'Data processed successfully']);
    }
}
