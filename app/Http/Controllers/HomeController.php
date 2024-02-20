<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Resident;
use App\Models\BarangayLGU;
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
            ->select(DB::raw("DATE_FORMAT(created_at, '%Y') as month"), DB::raw('COUNT(*) as total'))
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $residentsData->transform(function ($item) {
            $item->month = Carbon::createFromFormat('Y', $item->month)->format('Y');
            return $item;
        });

        $results = BarangayLGU::select('role', DB::raw('COUNT(*) as total'))
            ->groupBy('role')
            ->get();

     
        // Get by Age 
     
        $residents = Resident::all();
    
        // Initialize age groups with counts set to zero
        $ageGroups = [
            '0-11 months' => 0,
            '1-2 years' => 0,
            '3-5 years' => 0,
            '6-12 years' => 0,
            '13-17 years' => 0,
            '18-69 years' => 0,
            '60+ years' => 0
        ];
        
        $currentDate = Carbon::now();
        foreach ($residents as $resident) {
            $age = $currentDate->diffInYears($resident->dateOfBirth);
            
            if ($age <= 0) {
                $months = $currentDate->diffInMonths($resident->dateOfBirth);
                if ($months <= 11) {
                    $ageGroups['0-11 months']++;
                }
            } elseif ($age >= 1 && $age <= 2) {
                $ageGroups['1-2 years']++;
            } elseif ($age >= 3 && $age <= 5) {
                $ageGroups['3-5 years']++;
            } elseif ($age >= 6 && $age <= 12) {
                $ageGroups['6-12 years']++;
            } elseif ($age >= 13 && $age <= 17) {
                $ageGroups['13-17 years']++;
            } elseif ($age >= 18 && $age <= 69) {
                $ageGroups['18-69 years']++;
            } elseif ($age >= 60) {
                $ageGroups['60+ years']++;
            }
        }

        return view('dashboard', compact('residentsData', 'results', 'ageGroups'));
    }
}
