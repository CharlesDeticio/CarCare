<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;

class ServiceController extends Controller
{
    public function shwservice()
    {
        $services = Service::all();
        //return $services;
        return view('mechanic.dashboard', compact('services'));
    }

   public function add()
   {
        return view('mechanic.service.add');
    }

    public function storage(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
        ]);

        Service::create($request->all());

        return redirect()->route('mechanic.dashboard')->with('success', 'Service created successfully.');
    }

    public function shows(Service $service)
    {
        return view('mechanic.service.show', compact('service'));
    }

    public function destroys(Service $service)
    {
        $service->delete();
        
        return redirect()->route('mechanic.dashboard')->with('success', 'Service deleted successfully.');
    }
    
}
