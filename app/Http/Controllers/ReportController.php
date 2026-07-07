<?php

namespace App\Http\Controllers;

use App\Models\Booking;

class ReportController extends Controller
{
    public function index()
    {
        $bookings = Booking::with('guest', 'room.roomType')->latest()->paginate(10);
        return view('reports.index', compact('bookings'));
    }

    public function exportExcel()
    {
        $bookings = Booking::with('guest', 'room.roomType')->get();

        $headers = [
            "Content-type" => "application/vnd.ms-excel",
            "Content-Disposition" => "attachment; filename=laporan_reservasi.xls",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        ];

        return response()->view('reports.excel', compact('bookings'), 200, $headers);
    }

    public function print()
    {
        $bookings = Booking::with('guest', 'room.roomType')->get();
        return view('reports.print', compact('bookings'));
    }
}