<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBannerRequest;
use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function index()
    {
        $banners = Banner::all();
        return view('banner.list', compact('banners'));
    }

    public function create()
    {
        return view('banner.add');
    }

    public function store(StoreBannerRequest $request)
    {
        $destinationpath = 'uploads/banners/';
        $data = $request->except('banner_img');
        $imageFile = $request->banner_img;

        if ($imageFile) {
            $extension = strrchr($imageFile->getClientOriginalName(), '.');
            $new_file_name = "banner_" . time();
            $image = $imageFile->move($destinationpath, $new_file_name . $extension);
            $data['banner_img'] = isset($image) ? $new_file_name . $extension : NULL;
        }
        // dd($data);
        $banner = Banner::create($data);
        if ($banner) {
            return redirect()->route('banner.index')
                ->with('message', 'Banner is added successfully.');
        }
        return redirect()->back()
            ->withInput()
            ->withWarningMessage('Banner can not be added.');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
