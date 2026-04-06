<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\Status;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $reports = Report::with(['user', 'status'])->get();
        $statuses = Status::all();
        
        return view('admin.index', compact('reports', 'statuses'));
    }
    
    public function update(Request $request, Report $report)
    {
        $report->update([
            'status_id' => $request->status_id
        ]);
        
        return redirect()->back();
    }
}