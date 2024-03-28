<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Resident;
use Illuminate\Http\Request;
use App\Models\CertifacteLog;
use App\Models\People;

class CertLog extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->query('search');
        // $certLog = CertifacteLog::with("resident")->get();
        $certLog = Activity::when($search, function ($query) use ($search) {
            return $query->where('name', 'like', '%'.$search.'%') 
            ->orWhere('type', 'like', '%'.$search.'%');
        })
        ->orderBy('created_at', 'desc')
        ->paginate(10);
        return view("admin.certlog.index", compact("certLog", 'search'));
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
        // $certLog = new CertifacteLog();
        // $certLog->residentID = $request->user_id;
        // $certLog->certificate_type = $request->certType;
        // $certLog->save();

        $name = People::find($request->user_id);
        // save to logs
        $log = new Activity();
        $log->name = $name->firstName . " ". substr($name->middleName, 0,1) . " ". $name->lastName;
        $log->type = $request->certType;
        $log->date_logs = now();
        $log->save();

        return response()->json(["success" => "Successfully stored"]);
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
