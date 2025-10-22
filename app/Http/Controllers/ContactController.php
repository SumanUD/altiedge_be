<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Mail\ContactMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    // API Endpoint
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'mobile_no' => 'required|string|max:15',
            'message' => 'required|string',
        ]);

        // Save contact data
        $contact = Contact::create($validated);

        // Send emails
        $adminEmail = env('MAIL_FROM_ADDRESS'); // Admin’s email
        Mail::to($adminEmail)->send(new ContactMail($validated));
        Mail::to($validated['email'])->send(new ContactMail($validated));

        return response()->json([
            'success' => true,
            'message' => 'Your message has been sent successfully!',
        ]);
    }

    // Optional: List contacts in admin panel
    public function index()
    {
        $contacts = Contact::latest()->get();
        return view('admin.contacts.index', compact('contacts'));
    }
}
