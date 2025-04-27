<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MechanicReport;
use App\Models\Product;
use App\Models\Service;
use App\Models\Order;
use App\Models\OrderItem; // Import OrderItem Model
use App\Models\Booking;
use App\Models\User;
use App\Models\EmergencyBooking;
use App\Models\Report;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Log;
class MechanicReportController extends Controller
{
    /**
     * Display the report summary for the mechanic.
     */
    public function index()
{
    $mechanic_id = Auth::guard('mechanic')->id();

    $products = Product::where('mechanic_id', $mechanic_id)->get();
    $services = Service::where('mechanic_id', $mechanic_id)->get();

    $orders = Order::with(['user', 'product', 'mechanic', 'items.product'])
        ->whereHas('items.product', function ($query) use ($mechanic_id) {
            $query->where('mechanic_id', $mechanic_id);
        })
        ->where('status', 'completed')
        ->get();

    $bookings = Booking::with(['user', 'service', 'mechanic'])
        ->where('mechanic_id', $mechanic_id)
        ->where('status', 'completed')
        ->get();

    $emergencyBookings = EmergencyBooking::with(['user', 'mechanic'])
        ->where('mechanic_id', $mechanic_id)
        ->where('status', 'completed')
        ->get();

    $users = User::whereIn('id', $bookings->pluck('user_id'))->get();

    $totalUsersWhoBooked = $bookings->pluck('user_id')->unique()->count();
    $totalOrders = $orders->count();
    $totalProductInventory = $products->sum('Inventory');
    $remainingInventory = $products->sum('Inventory');
    $totalServices = $services->count();

    // ✅ Calculations
    $totalOrderPrice = $orders->sum('total_amount');

    $totalBookingsPrice = $bookings->sum(function ($booking) {
        return $booking->service->price ?? 0;
    });

    // ✅ Grand Total Sales = Orders + Bookings
    $totalSales = $totalOrderPrice + $totalBookingsPrice;

    return view('mechanic.reports.index', compact(
        'products',
        'services',
        'orders',
        'bookings',
        'users',
        'totalUsersWhoBooked',
        'totalOrders',
        'totalProductInventory',
        'remainingInventory',
        'totalServices',
        'emergencyBookings',
        'totalOrderPrice',
        'totalBookingsPrice',
        'totalSales'
    ));
}



    /**
     * Generate and download the PDF report.
     */
    public function generatePDF()
{
$mechanic = Auth::guard('mechanic')->user(); // Changed from id() to user()
    $mechanic_id = $mechanic->id;
    

    $products = Product::where('mechanic_id', $mechanic_id)->get();
    $services = Service::where('mechanic_id', $mechanic_id)->get();

    $orders = Order::with(['user', 'product', 'mechanic', 'items.product'])
        ->whereHas('items.product', function ($query) use ($mechanic_id) {
            $query->where('mechanic_id', $mechanic_id);
        })
        ->where('status', 'completed')
        ->get();

    $bookings = Booking::with(['user', 'service', 'mechanic'])
        ->where('mechanic_id', $mechanic_id)
        ->where('status', 'completed')
        ->get();

    $emergencyBookings = EmergencyBooking::with(['user', 'mechanic'])
        ->where('mechanic_id', $mechanic_id)
        ->where('status', 'completed')
        ->get();

    $users = User::whereIn('id', $bookings->pluck('user_id'))->get();

    // ✅ Summary counts
    $totalUsersWhoBooked = $bookings->count(); // ✅ Now storing total completed bookings
    $totalOrders = $orders->count();
    $totalProductInventory = $products->sum('Inventory');
    $remainingInventory = $products->sum('Inventory');
    $totalServices = $services->count();

    // ✅ Total prices
    $totalOrderPrice = $orders->sum('total_amount');

    $totalBookingsPrice = $bookings->sum(function ($booking) {
        return $booking->service->price ?? 0;
    });

    // ✅ Grand Total Sales = Orders + Bookings
    $totalSales = $totalOrderPrice + $totalBookingsPrice;

    // ✅ Optional: You can assign totalRevenue if it's the same as totalSales
    $totalRevenue = $totalSales;

    // ✅ Generate PDF
    $pdf = PDF::loadView('mechanic.reports.pdf', compact(
        'products',
        'services',
        'orders',
        'bookings',
        'users',
        'totalUsersWhoBooked',
        'totalOrders',
        'totalProductInventory',
        'remainingInventory',
        'totalServices',
        'emergencyBookings',
        'totalOrderPrice',      // ✅ Pass to PDF
        'totalBookingsPrice',   // ✅ Pass to PDF
        'totalSales',            // ✅ Pass to PDF
        'mechanic',
        
    ));

    $fileName = 'mechanic_report_' . date('Ymd_His') . '.pdf';
    $pdfPath = 'reports/' . $fileName;

    // ✅ Save PDF to storage
    $pdf->save(storage_path('app/public/' . $pdfPath));

    // ✅ Save report to DB
    MechanicReport::create([
        'mechanic_id'             => $mechanic_id,
        'total_users_booked'      => $totalUsersWhoBooked,
        'total_orders'            => $totalOrders,
        'total_product_inventory' => $totalProductInventory,
        'remaining_inventory'     => $remainingInventory,
        'total_services'          => $totalServices,
        'total_revenue'           => $totalRevenue,
        'pdf_path'                => $pdfPath,
        
    ]);

    return $pdf->download($fileName);
}



    /**
     * Show the history of mechanic reports.
     */
    public function history()
{
    $mechanic_id = Auth::guard('mechanic')->id();

    // Historical summary reports – paginated
    $reports = MechanicReport::where('mechanic_id', $mechanic_id)
                ->orderBy('created_at', 'desc')
                ->paginate(10, ['*'], 'reports_page');

    // Completed orders – paginated
    $orders = Order::with(['items.product', 'user'])
        ->whereHas('items.product', function ($query) use ($mechanic_id) {
            $query->where('mechanic_id', $mechanic_id);
        })
        ->where('status', 'completed')
        ->orderBy('created_at', 'desc')
        ->paginate(10, ['*'], 'orders_page');

    // Completed bookings – paginated
    $bookings = Booking::with(['user', 'service'])
        ->where('mechanic_id', $mechanic_id)
        ->where('status', 'completed')
        ->orderBy('booking_date', 'desc')
        ->paginate(10, ['*'], 'bookings_page');

    // Total unique users who completed bookings
    $totalUsersWhoBooked = $bookings->pluck('user_id')->unique()->count();

    return view('mechanic.reports.history', compact(
        'reports',
        'orders',
        'bookings',
        'totalUsersWhoBooked'
    ));
}

public function view($id)
{
    $report = MechanicReport::findOrFail($id);

    if ($report->mechanic_id !== auth('mechanic')->id()) {
        abort(403);
    }

    $startDate = $report->start_date ?? $report->created_at->startOfDay();
    $endDate = $report->end_date ?? $report->created_at->endOfDay();

    $orders = Order::with(['user', 'items.product'])
        ->whereHas('items.product', function($query) use ($report) {
            $query->where('mechanic_id', $report->mechanic_id);
        })
        ->where('status', 'completed')
        ->whereBetween('created_at', [$startDate, $endDate])
        ->orderBy('created_at', 'desc')
        ->get();

    $bookings = Booking::with(['user', 'service'])
        ->where('mechanic_id', $report->mechanic_id)
        ->where('status', 'completed')
        ->whereBetween('created_at', [$startDate, $endDate])
        ->orderBy('booking_date', 'desc')
        ->get();

    // Flags
    $newCompletedOrders = $orders->count() - $report->total_orders;
    $newCompletedBookings = $bookings->count() - $report->total_users_booked;

    $orders->each(function ($order, $index) use ($report) {
        $order->is_new = $index >= $report->total_orders;
    });

    $bookings->each(function ($booking, $index) use ($report) {
        $booking->is_new = $index >= $report->total_users_booked;
    });

    // Count mechanic-created entries
    $totalProductsCreated = \App\Models\Product::where('mechanic_id', $report->mechanic_id)->count();
    $totalServicesCreated = \App\Models\Service::where('mechanic_id', $report->mechanic_id)->count();

    return view('mechanic.reports.view', compact(
        'report', 'orders', 'bookings',
        'newCompletedOrders', 'newCompletedBookings',
        'totalProductsCreated', 'totalServicesCreated'
    ));
}

public function destroy($id)
{
    $report = Report::findOrFail($id);
    
    // Authorization check
    if ($report->mechanic_id !== auth('mechanic')->id()) {
        abort(403, 'Unauthorized action.');
    }

    $report->delete();
    
    return redirect()->route('mechanic.reports.history')
        ->with('success', 'Report deleted successfully');
}

}
