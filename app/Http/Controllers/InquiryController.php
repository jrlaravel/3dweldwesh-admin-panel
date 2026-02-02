<?php

namespace App\Http\Controllers;

use App\Models\Inquiry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class InquiryController extends Controller
{
    public function index()
    {
        $inquiries = Inquiry::latest()->get();
        return view('inquiry', compact('inquiries'));
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'            => 'required|string|max:255',
            'email'           => 'required|email|max:255',
            'phone'           => 'required|string|max:20',
            'message'         => 'nullable|string',
            'location'        => 'nullable|string|max:255',
            'fencing_needed'  => 'nullable|boolean',
            'project_type'    => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Validation failed',
                'errors'  => $validator->errors(),
            ], 422);
        }

        $inquiry = Inquiry::create([
            'name'           => $request->name,
            'email'          => $request->email,
            'phone'          => $request->phone,
            'message'        => $request->message,
            'location'       => $request->location,
            'fencing_needed' => $request->fencing_needed,
            'project_type'   => $request->project_type,
        ]);

        return response()->json([
            'status'  => 'success',
            'message' => 'Inquiry submitted successfully',
            'data'    => $inquiry,
        ], 201);
    }
}
