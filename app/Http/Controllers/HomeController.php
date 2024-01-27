<?php

namespace App\Http\Controllers;

use App\Models\BarangayLGU;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function dashboard()
    {
        // In your controller, fetch data from the database
        // postgresql
        // $residentsData = DB::table('residents')
        //     ->select(DB::raw("to_char(created_at, 'YYYY-MM') as month"), DB::raw('COUNT(*) as total'))
        //     ->groupBy('month')
        //     ->orderBy('month')
        //     ->get();

        // mysql
        $residentsData = DB::table('residents')
            ->select(DB::raw("DATE_FORMAT(created_at, '%Y-%m') as month"), DB::raw('COUNT(*) as total'))
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $residentsData->transform(function ($item) {
            $item->month = Carbon::createFromFormat('Y-m', $item->month)->format('M Y');
            return $item;
        });

        $results = BarangayLGU::select('role', DB::raw('COUNT(*) as total'))
            ->groupBy('role')
            ->get();

        // $total_secretary_and_treasurer = BarangayLGU::select(
        //     'role',
        //     DB::raw('SUM(IF(isSecretary = "1", 1, 0)) as isSecretary')
        // )
        //     ->where('role', 'councilors')
        //     ->groupBy('role')
        //     ->get();




        return view('dashboard', compact('residentsData', 'results'));
    }
}
