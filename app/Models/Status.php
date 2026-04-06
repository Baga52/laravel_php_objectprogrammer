<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Status extends Model
{
    public function reports(): HasMany
    {
        return $this -> hasMany(Report::class);
    }
    public function index()
    {
        $reports = Report::with(['user', 'status'])->get();
        $statuses = Status::all();

        return view('admin.index', compact('reports', 'statuses'));
    }
}
