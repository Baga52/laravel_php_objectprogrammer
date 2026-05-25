<?php

namespace App\Http\Controllers;

use Intervention\Image\Laravel\Facades\Image;
use Intervention\Image\Encoders\WebpEncoder;
use App\Models\Report;
use App\Models\Status;
use App\Models\User;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $sort = $request->input('sort');
        if ($sort != 'asc' && $sort != 'desc') {
            $sort = 'desc';
        }
        $status = $request->input('status');
        $validate = $request->validate([
            'status' => "exists:statuses,id"
        ]);
        if ($validate) {
            $reports = Report::where('status_id', $status)
                ->where('user_id', FacadesAuth::user()->id)
                ->orderBy('created_at', $sort)
                ->paginate(8);
        } else {
            $reports = Report::where('user_id', FacadesAuth::user()->id)
                ->orderBy('created_at', $sort)
                ->paginate(8);
        }
        $statuses = Status::all();
        return view('report.index', compact('reports', 'statuses', 'sort', 'status'));
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

    public function store(Request $request)
    {
        $validated = $request->validate([
            'car_number' => 'required|string|max:255',
            'description' => 'required|string',
            'path_img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
        ]);

        if ($request->hasFile('path_img')) {
            $file = $request->file('path_img');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('reports', $fileName, 'public');
            $validated['path_img'] = $fileName;
        }

        $validated['user_id'] = auth()->id();
        $validated['status_id'] = 1;

        Report::create($validated);

        return redirect()->route('reports.index')
            ->with('success', 'Заявление успешно создано!');
    }

    public function destroy(Report $report)
    {
        $report->delete();

        return redirect()->route('reports.index')
            ->with('success', 'Заявление успешно удалено!');
    }

    public function edit(Report $report)
    {
        if (FacadesAuth::user()->id === $report->user_id) {
            return view('report.edit', compact('report'));
        } else {
            abort(403, 'У вас нет прав на редактирование этой записи.');
        }
    }

    public function update(Request $request, Report $report)
    {
        $validated = $request->validate([
            'car_number' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $report->update($validated);

        return redirect()->route('reports.index')
            ->with('success', 'Заявление успешно обновлено!');
    }
    public function statusUpdate(Request $request, Report $report)
    {
        $request->validate([
            'status_id' => 'required|exists:statuses,id',
        ]);

        $report->update($request->only(['status_id']));

        return redirect()->back()
            ->with('success', 'Статус изменён!');
    }
}
