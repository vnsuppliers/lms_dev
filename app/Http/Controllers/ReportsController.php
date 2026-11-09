<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportsController extends Controller
{
    public function reports_index()
    {
        return view('admin.reports.reports');
    }

    public function fetch_reportcourses_details(Request $request)
    {
        return view('admin.reports.reports');
    }

    public function get_reportcourses_based_on_filters(Request $request)
    {
        return view('admin.reports.reports');
    }
}
