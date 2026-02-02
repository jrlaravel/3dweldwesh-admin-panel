<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Service;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class ApiController extends Controller
{
        public function products()
    {
        $products = Product::with('image')->latest()->get();

        return response()->json([
            'status' => 'success',
            'data'   => $products,
        ]);
    }

    /**
     * GET – Services
     */
    public function services()
    {
        $services = Service::with('image')->latest()->get();

        return response()->json([
            'status' => 'success',
            'data'   => $services,
        ]);
    }

    /**
     * GET – Testimonials
     */
    public function testimonials()
    {
        $testimonials = Testimonial::with('image')->latest()->get();

        return response()->json([
            'status' => 'success',
            'data'   => $testimonials,
        ]);
    }

}
