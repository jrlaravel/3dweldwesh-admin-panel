<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Service;
use App\Models\Testimonial;
use App\Models\Inquiry;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $productCount = Product::count();
        $serviceCount = Service::count();
        $testimonialCount = Testimonial::count();
        $inquiryCount = Inquiry::count();

        $recentInquiries = Inquiry::orderBy('created_at', 'desc')->take(5)->get();

        // Data for chart (inquiries per month for the last 6 months)
        $months = [];
        $counts = [];
        for ($i = 5; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $months[] = $date->format('M');
            $counts[] = Inquiry::whereYear('created_at', $date->year)
                                ->whereMonth('created_at', $date->month)
                                ->count();
        }

        return view('dashboard', compact(
            'productCount',
            'serviceCount',
            'testimonialCount',
            'inquiryCount',
            'recentInquiries',
            'months',
            'counts'
        ));
    }
}
