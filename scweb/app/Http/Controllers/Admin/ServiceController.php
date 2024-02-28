<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use Cache;

class ServiceController extends Controller
{
    public function index () {
        $services = Service::all();
        return view('admin.services.index',compact('services'));
    }

    public function create () {
        return view('admin.services.create');
    }
    public function store (Request $request) {
        $request->validate([
            'title'   => 'required|max:255',
            'content' => 'required',
            'summary' => 'required|max:255',
        ]);
        // dd(strlen($request->summary));
        $service = Service::create([
            'title'   => $request->title,
            'summary' => $request->summary,
            'content' => $request->content,
        ]);

        Cache::forget('services');

        return redirect()->route('admin.services.index')->with('success', 'Service added successfully');
    }

    public function edit (Service $service) {
        return view('admin.services.edit', compact('service'));
    }
    public function update (Request $request, Service $service) {

        $request->validate([
            'title'   => 'required|max:255',
            'summary' =>  'required|max:255',
            'content' => 'required',
        ]);
        $service->update([
            'title'   => $request->title,
            'summary' => $request->summary,
            'content' => $request->content,
        ]);

        Cache::forget('services');

        return redirect()->route('admin.services.index')->with('success', 'Service updated successfully');
    }

    public function delete (Service $service) {
        $service->delete();
        return redirect()->route('admin.services.index')->with('success', 'Service deleted successfully');
    }


}
