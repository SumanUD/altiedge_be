<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use App\Models\Event;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EnrollmentController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'mobile_no' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'address' => 'nullable|string',
            'type' => 'required|in:program,event',
            'reference_id' => 'required|integer',
        ]);

        // Check if reference exists
        if ($validated['type'] === 'program') {
            Program::findOrFail($validated['reference_id']);
        } else {
            Event::findOrFail($validated['reference_id']);
        }

        $enrollment = Enrollment::create($validated);

// Send email to admin
Mail::send([], [], function ($message) use ($enrollment) {
    $htmlContent = '
    <html>
    <head>
        <style>
            body {
                font-family: "Poppins", sans-serif;
                background-color: #f6f8fb;
                color: #333;
                margin: 0;
                padding: 20px;
            }
            .container {
                max-width: 600px;
                background: #ffffff;
                margin: 0 auto;
                padding: 30px 40px;
                border-radius: 12px;
                box-shadow: 0 4px 15px rgba(0,0,0,0.08);
                border-top: 6px solid #007bff;
            }
            h2 {
                text-align: center;
                color: #007bff;
                font-size: 24px;
                margin-bottom: 25px;
            }
            p {
                font-size: 15px;
                line-height: 1.6;
                margin: 10px 0;
            }
            strong {
                color: #222;
            }
            .footer {
                text-align: center;
                margin-top: 30px;
                font-size: 13px;
                color: #888;
                border-top: 1px solid #eee;
                padding-top: 12px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <h2>📩 New Enrollment Received</h2>
            <p><strong>Name:</strong> ' . e($enrollment->name) . '</p>
            <p><strong>Email:</strong> ' . e($enrollment->email) . '</p>
            <p><strong>Mobile:</strong> ' . e($enrollment->mobile_no) . '</p>
            <p><strong>Address:</strong> ' . e($enrollment->address) . '</p>
            <p><strong>Type:</strong> ' . e($enrollment->type) . '</p>
            <p><strong>Reference ID:</strong> ' . e($enrollment->reference_id) . '</p>
            <div class="footer">
                This email was automatically generated from your website enrollment form.
            </div>
        </div>
    </body>
    </html>';

    $message->to(config('mail.from.address'))
            ->subject('New Enrollment Received')
            ->html($htmlContent);
});


// Send email to user
Mail::send([], [], function ($message) use ($enrollment) {
    $htmlContent = '
    <html>
    <head>
        <style>
            body {
                font-family: "Poppins", sans-serif;
                background-color: #f6f8fb;
                color: #333;
                margin: 0;
                padding: 20px;
            }
            .container {
                max-width: 600px;
                background: #ffffff;
                margin: 0 auto;
                padding: 30px 40px;
                border-radius: 12px;
                box-shadow: 0 4px 15px rgba(0,0,0,0.08);
                border-top: 6px solid #28a745;
            }
            h2 {
                text-align: center;
                color: #28a745;
                font-size: 24px;
                margin-bottom: 25px;
            }
            p {
                font-size: 15px;
                line-height: 1.6;
                margin: 10px 0;
            }
            .footer {
                text-align: center;
                margin-top: 30px;
                font-size: 13px;
                color: #888;
                border-top: 1px solid #eee;
                padding-top: 12px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <h2>✅ Enrollment Confirmation</h2>
            <p>Dear <strong>' . e($enrollment->name) . '</strong>,</p>
            <p>Thank you for enrolling in our <strong>' . e($enrollment->type) . '</strong>.</p>
            <p>We appreciate your interest and will contact you soon with more details.</p>
            <p>Best regards,<br><strong>Team</strong></p>
            <div class="footer">
                This is an automated message — please do not reply.
            </div>
        </div>
    </body>
    </html>';

    $message->to($enrollment->email)
            ->subject('Enrollment Confirmation')
            ->html($htmlContent);
});

        return response()->json([
            'success' => true,
            'message' => 'Enrollment successful!',
            'data' => $enrollment
        ]);
    }

    // Admin view
    public function index()
    {
        $enrollments = Enrollment::latest()->get();
        return view('admin.enrollments.index', compact('enrollments'));
    }
}
