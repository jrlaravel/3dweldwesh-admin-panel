<?php

namespace App\Http\Controllers;

use App\Models\MediaManager;
use App\Models\Product;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TestimonialController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::with('image')->get();
        return view('testimonial', compact('testimonials'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'location' => ['required', 'string', 'max:255'],
            'message' => ['nullable', 'string'],
            'designation' => ['required', 'string', 'max:255'],
            'image' => ['required', 'file'],
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Upload image
        $path = $request->file('image')->store('testimonials', 'public');

        $media = MediaManager::create([
            'path' => $path,
            'name' => $request->file('image')->getClientOriginalName(),
        ]);

        $testimonial = Testimonial::create([
            'name' => $request->name,
            'designation' => $request->designation,
            'location' => $request->location,
            'message' => $request->message,
            'image_id' => $media->id,
        ]);


        return redirect()->route('testimonial')->with('success', 'Testimonial added successfully!');
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => ['required', 'exists:testimonial,id'],
            'name' => ['sometimes', 'string', 'max:255'],
            'location' => ['sometimes', 'string', 'max:255'],
            'designation' => ['sometimes', 'string', 'max:255'],
            'message' => ['sometimes', 'string'],
            'image' => ['sometimes', 'image', 'max:2048'],
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $testimonial = Testimonial::findOrFail($request->id);

        // If new image uploaded
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('testimonials', 'public');

            $media = MediaManager::create([
                'path' => $path,
                'type' => 'image',
            ]);

            $testimonial->image_id = $media->id;
        }

        $testimonial->update([
            'name' => $request->name ?? $testimonial->name,
            'designation' => $request->designation ?? $testimonial->designation,
            'location' => $request->location ?? $testimonial->location,
            'message' => $request->message ?? $testimonial->message,
        ]);

        return redirect()->route('testimonial')->with('success', 'Testimonial updated successfully!');
    }


    public function edit($id)
    {
        $testimonial = Testimonial::with('image')->findOrFail($id);
        return response()->json($testimonial);
    }

    public function delete($id)
    {
        $testimonial = Testimonial::findOrFail($id);
        $testimonial->delete();

        return back()->with('success', 'Testimonial deleted successfully!');
    }
}
