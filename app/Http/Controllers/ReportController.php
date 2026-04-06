<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\Status;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $sort = $request->input('sort');
        if($sort != 'asc' && $sort != 'desc'){
            $sort = 'desc';
        }
        $status = $request->input('status');
        $validate = $request->validate([
            'status' => "exists:statuses,id"
        ]);
        if($validate){
            $reports = Report::where('status_id', $status)
            ->where('user_id', FacadesAuth::user()->id)
            ->orderBy('created_at', $sort)
            ->paginate(8);
        }
        else{
            $reports = Report::where('user_id', FacadesAuth::user()->id)
            ->orderBy('created_at', $sort)
            ->paginate(8);
        }
        $statuses = Status::all();
        return view('report.index', compact('reports', 'statuses','sort','status'));
    }
    public function show(Report $report)
    {
        if (FacadesAuth::user()->id !== $report->user_id) {
            abort(403, 'У вас нет прав на просмотр этой записи.');
        }
        return view('reports.show', compact('report'));
    }
    
    public function create()
    {
        return view('report.create');
    }
    
    public function store(Request $request, Report $report){
        $data = $request -> validate([
            'car_number' => 'string',
            'description' => 'string',
        ]);
        $data['user_id'] = FacadesAuth::user()->id;
        $data['status_id'] = 1;

        $report->create($data);
        return redirect()->back();
    }
    
    public function destroy(Report $report)
    {
        if (FacadesAuth::user()->id !== $report->user_id) {
        abort(403, 'У вас нет прав на удаление этой записи.');
    }
        $report->delete();
        
        return redirect()->route('reports.index');
    }
    
    public function edit(Report $report)
    {
        if (FacadesAuth::user()->id === $report->user_id){
        return view('report.edit', compact('report'));
        }
        else{
            abort(403, 'У вас нет прав на редактирование этой записи.');
        }
    }

    public function statusUpdate(Request $request, Report $report)
{
    $request->validate([
        'status_id' => 'required|exists:statuses,id',
    ]);
    
    $report->update($request->only(['status_id']));
    
    return redirect()->back();
}
}