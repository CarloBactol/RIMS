<?php

namespace App\Http\Controllers;

use App\Models\People;
use App\Models\Blotter;
use App\Models\BarangayLGU;
use Illuminate\Http\Request;

class BlotterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->query('search');
    
        $blotters = Blotter::query()
            ->when($search, function ($query) use ($search) {
                return $query->where('description', 'like', '%'.$search.'%')
                             ->orWhereHas('respondent', function ($query) use ($search) {
                                 $query->where('lastName', 'like', '%'.$search.'%');
                             });
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

            $isTrue = Blotter::select('respondent_id')
            ->groupBy('respondent_id')
            ->havingRaw('COUNT(*) >= 3')
            ->pluck('respondent_id');

        return view('admin.blotter.index', compact('blotters', 'search', 'isTrue' ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $people = People::all();
        return view('admin.blotter.create', compact("people"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Blotter $blotter)
    {
        $this->validate($request, ["complainant_id" => "required",
                                                    "respondent_id" => "required", 
                                                    "description" => "required|string|min:10"
                                                    ]);
        $blotter->create($request->all());
        return redirect()->route("blotters.index")->with("success", "Blotter Created Successfully!");    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $blotters = Blotter::find($id);
        $captain =  BarangayLGU::where('role', 'Captain')->first();
        $secretary =  BarangayLGU::where('role', 'Secretary')->where('isSecretary', false)->first();
        $treasurer =  BarangayLGU::where('role', 'Treasurer')->where('isTreasurer', false)->first();

    return view('admin.blotter.show', compact('blotters',  'captain', 'secretary', 'treasurer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $blotters = Blotter::find($id);
        $people = People::all();
        return view('admin.blotter.edit', compact("blotters", "people"));
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
        $this->validate($request, ["complainant_id" => "required",
        "respondent_id" => "required", 
        "description" => "required|string|min:10"
        ]);

       $blotters = Blotter::find($id);
         $blotters->update($request->all());      
         return redirect()->route("blotters.index")->with("info", "Blotter Updated Successfully!");     
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = Blotter::findorFail($id);
        $delete->delete();
        return redirect()->back()->with('danger', 'Blotter Deleted Successfully!');
    }
}
