<?php

namespace Acelle\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Acelle\Model\GalleryImage;

class GalleryImageController extends Controller
{
    public function index()
    {
        $images = GalleryImage::where('user_id', Auth::user()->id)->get();
        return view('service_provider.gallery', compact('images'));
    }

    public function create()
    {
        return view('service_provider.addGallery');
    }

public function store(Request $request)
{
    // dd($request->all());
    $request->validate([
        'images.*' => 'required',
    ]);

    foreach ($request->file('images') as $uploadedImage) {

    	   $image = $uploadedImage;
            $imagePath = time().$image->getClientOriginalName();
            $destination = 'frontend-assets/images';
            $image->move(public_path($destination),$imagePath);

        $image = new GalleryImage([
            'image' => $imagePath,
            'user_id' => Auth::user()->id,
        ]);

        $image->save();
    }

    return redirect('/service-provider/gallery')->with('success', 'Images added successfully.');
}
public function edit($account, $id)
    {
        $image = GalleryImage::findOrFail($id);
        return view('service_provider.addGallery', compact('image'));
    }
public function update(Request $request, $id)
{
    $request->validate([
        'images.*' => 'required',
    ]);

    $imagePaths = [];

    foreach ($request->file('images') as $uploadedImage) {
        $imagePath = time() . $uploadedImage->getClientOriginalName();
        $destination = 'frontend-assets/images';
        $uploadedImage->move(public_path($destination), $imagePath);
        $imagePaths[] = $imagePath;
    }

    $image = GalleryImage::findOrFail($id);

    // Delete the existing images
    foreach ($image->image as $existingImagePath) {
        // Construct the full path to the image
        $fullPath = public_path($existingImagePath);
        
        // Check if the file exists before attempting to delete it
        if (file_exists($fullPath)) {
            unlink($fullPath); // Delete the file
        }
    }

    // Update the gallery images
    $image->image = $imagePaths;
    $image->user_id = Auth::user()->id;
    $image->save();

    return redirect('/service-provider/gallery')->with('success', 'Images updated successfully.');
}



    public function destroy($account, $id)
    {
        $image = GalleryImage::findOrFail($id);
        Storage::disk('public')->delete($image->path);
        $image->delete();

        return redirect('/service-provider/gallery')->with('success', 'Image deleted successfully.');
    }
}

