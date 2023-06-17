<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home(){
        $title = "Dashboard";
        return view('index', [
            // 'index' => $result,
            // 'chartcount'=> $ccount,
            // 'chartdate'=> $cdate,
            // 'totalMonthlyVisitors' => $totalMonthlyVisitors,
            // 'totalOnline' => $totalOnline,
            'title' => $title,
        ]);
    }
    public function readers()
    {
        $title = "Home";
        return view('readers/readers', [
            'title' => $title,
        ]);
    }
}