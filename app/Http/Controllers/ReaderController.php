<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReaderController extends Controller
{
    public function detailreader()
    {
        $title = "Detail";
        return view('readers/detailreader', [
            'title' => $title,
        ]);
    }
    public function aboutus()
    {
        $title = "About LPM Paraga";
        return view('readers/aboutus', [
            'title' => $title,
        ]);
    }
    public function contactus()
    {
        $title = "Contact LPM Paraga";
        return view('readers/contactus', [
            'title' => $title,
        ]);
    }
}