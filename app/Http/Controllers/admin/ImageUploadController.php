<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Images;
use App\Models\Property;
use Illuminate\Http\Request;

class ImageUploadController extends Controller
{
    public function index($propertyId)
    {
        $title = 'Upload Images';
        $images = Images::where('property_id', $propertyId)->get();
        return view('admin.properties.propertyImages', [
            'title' => $title,
            'images' => $images,
            'propertyId' => $propertyId,
        ]);
    }

    public function store(Request $request)
    {

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $image_path = $file->store('/', [
                'disk' => 'upload',
            ]);
            Images::create([
                'path' => $image_path,
                'property_id' => $request->property_id
            ]);
        }
    }
}
