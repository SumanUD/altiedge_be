<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    // Show all blogs in AdminLTE table
    public function index()
    {
        $blogs = Blog::latest()->get();
        return view('admin.blogs.index', compact('blogs'));
    }

    // Show create form
    public function create()
    {
        return view('admin.blogs.create');
    }

    // Store new blog
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'banner_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'tags' => 'nullable|string',
            'location' => 'nullable|string',
            'description' => 'nullable|string',
        ]);

        if ($request->hasFile('banner_image')) {
            $validated['banner_image'] = $request->file('banner_image')->store('blogs', 'public');
        }

        Blog::create($validated);

        return redirect()->route('blogs.index')->with('success', 'Blog created successfully.');
    }

    // Show edit form
    public function edit(Blog $blog)
    {
        return view('admin.blogs.edit', compact('blog'));
    }

    // Update existing blog
    public function update(Request $request, Blog $blog)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'banner_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'tags' => 'nullable|string',
            'location' => 'nullable|string',
            'description' => 'nullable|string',
        ]);

        if ($request->hasFile('banner_image')) {
            if ($blog->banner_image) {
                Storage::disk('public')->delete($blog->banner_image);
            }
            $validated['banner_image'] = $request->file('banner_image')->store('blogs', 'public');
        }

        $blog->update($validated);

        return redirect()->route('blogs.index')->with('success', 'Blog updated successfully.');
    }

    // Delete a blog
    public function destroy(Blog $blog)
    {
        if ($blog->banner_image) {
            Storage::disk('public')->delete($blog->banner_image);
        }
        $blog->delete();

        return redirect()->route('blogs.index')->with('success', 'Blog deleted successfully.');
    }

    // API endpoint for Next.js frontend
    public function apiIndex($id = null)
    {
        if ($id) {
            $blog = Blog::find($id);
            if (!$blog) {
                return response()->json(['message' => 'Blog not found'], 404);
            }
            return response()->json($blog);
        }

        $blogs = Blog::latest()->get();
        return response()->json($blogs);
    }

    public function apiShow($id)
    {
        $blog = Blog::findOrFail($id);
        return response()->json($blog);
    }
}
