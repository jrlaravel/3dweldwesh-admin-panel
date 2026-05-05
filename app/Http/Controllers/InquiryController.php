<?php

namespace App\Http\Controllers;

use App\Models\Inquiry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use App\Mail\InquiryAdminNotification;
use App\Mail\InquiryUserConfirmation;


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
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'message' => 'nullable|string',
            'location' => 'nullable|string|max:255',
            'fencing_needed' => 'nullable|string',
            'project_type' => 'nullable|string|max:255',
            'g-recaptcha-response' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }

        // 🔐 Verify reCAPTCHA
        $recaptchaResponse = Http::asForm()->post(
            'https://www.google.com/recaptcha/api/siteverify',
            [
                'secret' => env('RECAPTCHA_SECRET_KEY'),
                'response' => $request->input('g-recaptcha-response'),
                'remoteip' => $request->ip(),
            ]
        );

        if (!($recaptchaResponse->json()['success'] ?? false)) {
            return response()->json([
                'status' => 'error',
                'message' => 'reCAPTCHA verification failed',
            ], 422);
        }

        $inquiry = Inquiry::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'message' => $request->message,
            'location' => $request->location,
            'fencing_needed' => $request->fencing_needed,
            'project_type' => $request->project_type,
        ]);

        // 📧 Send Emails
        try {
            // Send to Admin
            $adminEmail = env('MAIL_FROM_ADDRESS');
            Mail::to($adminEmail)->queue(new InquiryAdminNotification($inquiry));

            // Send to User
            Mail::to($inquiry->email)->queue(new InquiryUserConfirmation($inquiry));
        } catch (\Exception $e) {
            \Log::error('Mail sending failed: ' . $e->getMessage());
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Inquiry submitted successfully',
            'data' => $inquiry,
        ], 201);
    }

}
