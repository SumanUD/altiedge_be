<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PageSection;
use App\Models\PageRepeat;
use Illuminate\Support\Facades\Storage;

class PageCMSController extends Controller
{
    /**
     * Get all sections for a given page (used by Next.js frontend)
     */
    public function getPageData($page_name)
    {
        $sections = PageSection::where('page_name', $page_name)->get();
        $repeats = PageRepeat::where('page_name', $page_name)->get();

        return response()->json([
            'sections' => $sections,
            'repeats' => $repeats,
        ]);
    }

    /**
     * Update or create a single text section (AdminLTE)
     */
    public function updateSection(Request $request)
    {
        $validated = $request->validate([
            'page_name' => 'required|string',
            'section_key' => 'required|string',
            'content' => 'nullable|string',
        ]);

        $section = PageSection::updateOrCreate(
            [
                'page_name' => $validated['page_name'],
                'section_key' => $validated['section_key'],
            ],
            ['content' => $validated['content']]
        );

        return response()->json([
            'success' => true,
            'message' => 'Section updated successfully',
            'data' => $section,
        ]);
    }

    /**
     * Store new repeatable section item (testimonial / team member)
     */
    public function storeRepeat(Request $request)
    {
        $validated = $request->validate([
            'page_name' => 'required|string',
            'section_key' => 'required|string',
            'name' => 'nullable|string',
            'designation' => 'nullable|string',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
        ]);

        $data = $validated;

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('uploads/page-repeats', 'public');
        }

        $repeat = PageRepeat::create($data);

        return response()->json([
            'success' => true,
            'message' => 'Item added successfully',
            'data' => $repeat,
        ]);
    }

    /**
     * Delete a repeatable section item
     */
    public function deleteRepeat($id)
    {
        $repeat = PageRepeat::findOrFail($id);
        if ($repeat->image && Storage::disk('public')->exists($repeat->image)) {
            Storage::disk('public')->delete($repeat->image);
        }
        $repeat->delete();

        return response()->json([
            'success' => true,
            'message' => 'Item deleted successfully',
        ]);
    }

    /**
     * AdminLTE page loader (shows all content for a page)
     */
    public function edit($page_name)
    {
        $sections = PageSection::where('page_name', $page_name)->get()->keyBy('section_key');
        $repeats = PageRepeat::where('page_name', $page_name)->get()->groupBy('section_key');
        return view('admin.pages.edit', compact('page_name', 'sections', 'repeats'));
    }
}
