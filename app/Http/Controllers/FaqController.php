<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    // Show all FAQs
    public function index()
    {
        $faqs = Faq::orderBy('id', 'desc')->get();
        return view('admin.faqs.index', compact('faqs'));
    }

    // Show create form
    public function create()
    {
        $faq = new Faq(); // empty model for form
        return view('admin.faqs.form', compact('faq'));
    }

    // Store new FAQ
    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
            'is_active' => 'sometimes|boolean',
        ]);

        Faq::create($request->only('question', 'answer', 'is_active'));

        return redirect()->route('faqs.index')->with('success', 'FAQ created successfully.');
    }

    // Show edit form
    public function edit(Faq $faq)
    {
        return view('admin.faqs.form', compact('faq'));
    }

    // Update FAQ
    public function update(Request $request, Faq $faq)
    {
        $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
            'is_active' => 'sometimes|boolean',
        ]);

        $faq->update($request->only('question', 'answer', 'is_active'));

        return redirect()->route('faqs.index')->with('success', 'FAQ updated successfully.');
    }

    // Delete FAQ
    public function destroy(Faq $faq)
    {
        $faq->delete();
        return redirect()->route('faqs.index')->with('success', 'FAQ deleted successfully.');
    }

    // API for frontend
    public function apiIndex()
    {
        $faqs = Faq::where('is_active', true)->orderBy('id', 'desc')->get();
        return response()->json($faqs);
    }
}
