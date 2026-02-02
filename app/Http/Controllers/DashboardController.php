<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductLinks;
use App\Models\Inquiry; // assuming inquiry table
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{

    public function index()
    {
        return view('dashboard');
    }
}
