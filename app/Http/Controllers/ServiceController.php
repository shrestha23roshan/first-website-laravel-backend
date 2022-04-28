<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreServiceRequest;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::all();
        return view('service.list', compact('services'));
    }

    public function create()
    {
        return view('service.add');
    }

    public function store(StoreServiceRequest $request)
    {
        $destinationpath = "uploads/services/";
        $data = $request->except('service_img');
        // dd($data);
        $imageFile = $request->service_img;

        if ($imageFile) {
            $extension = strrchr($imageFile->getClientOriginalName(), '.');
            $new_file_name = "service_" . time();
            $image = $imageFile->move($destinationpath, $new_file_name . $extension);
            $data['service_img'] = isset($image) ? $new_file_name . $extension : NULL;
        }

        $service = Service::create($data);

        if ($service) {
            return redirect()->route('service.index')
                ->with('message', 'Service is added successfully.');
        }
        return redirect()->back()
            ->withInput()
            ->with('message', 'About can not be added.');
    }
}
