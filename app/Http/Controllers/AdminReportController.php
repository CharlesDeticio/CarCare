<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Mechanic;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class AdminReportController extends Controller
{
    // Show Admin Dashboard
    public function index()
    {
        $totalUsers = User::count();
        $totalMechanics = Mechanic::where('verified', true)->count();

        // Load the admin report view
        return view('admin.reports.index', compact('totalUsers', 'totalMechanics'));
    }

    // Generate & Save PDF
    public function downloadPDF()
    {
        $totalUsers = User::count();
        $totalMechanics = Mechanic::where('verified', true)->count();

        // Generate PDF from Blade view
        $pdf = Pdf::loadView('admin.reports.pdf', [
            'totalUsers' => $totalUsers,
            'totalMechanics' => $totalMechanics,
        ]);

        // Define folder and filename
        $folderPath = 'adminreport'; // inside storage/app/public/
        $fileName = 'admin_report_' . date('Ymd_His') . '.pdf';
        $fullPath = $folderPath . '/' . $fileName;

        // Ensure the directory exists
        if (!Storage::exists('public/' . $folderPath)) {
            Storage::makeDirectory('public/' . $folderPath);
        }

        // Save PDF to the folder
        Storage::put('public/' . $fullPath, $pdf->output());

        // If you want to return download directly
    return $pdf->download($fileName);
    }
}
