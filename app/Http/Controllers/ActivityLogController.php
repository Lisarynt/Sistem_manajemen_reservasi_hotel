<?php

namespace App\Http\Controllers;

use Spatie\Activitylog\Models\Activity;

class ActivityLogController extends Controller
{
    public function index()
    {
        // Hanya admin yang boleh lihat activity log
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Hanya admin yang memiliki akses ini.');
        }

        $activities = Activity::with('causer')
            ->latest()
            ->paginate(20);

        return view('activity-log.index', compact('activities'));
    }
}