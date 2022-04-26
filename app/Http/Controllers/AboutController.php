<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAboutRequest;
use App\Models\About;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        $abouts = About::all();
        return view('about.list', compact('abouts'));
    }

    public function create()
    {
        return view('about.add');
    }

    public function store(StoreAboutRequest $request)
    {
        $destinationpath = 'uploads/abouts/';
        $data = $request->except('about_img');
        $imageFile = $request->about_img;

        if ($imageFile) {
            $extension = strrchr($imageFile->getClientOriginalName(), '.');
            $new_file_name = "about_" . time();
            $image = $imageFile->move($destinationpath, $new_file_name . $extension);
            $data['about_img'] = isset($image) ? $new_file_name . $extension : NULL;
        }
        // dd($data);
        $about = About::create($data);
        if ($about) {
            return redirect()->route('about.index')
                ->with('message', 'About is added successfully.');
        }
        return redirect()->back()
            ->withInput()
            ->withWarningMessage('About can not be added.');
    }
}
