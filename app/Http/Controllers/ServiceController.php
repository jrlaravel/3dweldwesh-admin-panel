<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\MediaManager;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::with('image')->get();
        return view('service', compact('services'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'description'=>'required',
            'image'=>'required'
        ]);

        $path = $request->file('image')->store('services','public');

        $media = MediaManager::create(['path'=>$path, 'name'=>$request->file('image')->getClientOriginalName()]);

        Service::create([
            'name'=>$request->name,
            'description'=>$request->description,
            'image_id'=>$media->id
        ]);

        return back()->with('success','Service added');
    }

    public function edit($id)
    {
        return Service::with('image')->findOrFail($id);
    }

    public function update(Request $request)
    {
        $service = Service::findOrFail($request->id);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('services','public');
            $media = MediaManager::create(['path'=>$path,'name'=>$request->file('image')->getClientOriginalName()]);
            $service->image_id = $media->id;
        }

        $service->update([
                'name' => $request->name ?? $service->name,
                'description' => $request->description ?? $service->description
                ]);

        return back()->with('success','Service updated');
    }

    public function delete($id)
    {
        Service::findOrFail($id)->delete();
        return back()->with('success','Service deleted');
    }
}
