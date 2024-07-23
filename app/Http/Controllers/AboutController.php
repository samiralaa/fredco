<?php

namespace App\Http\Controllers;

use App\Models\About;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
class AboutController
{
    public function index()
    {
        $abouts = About::with('media')->get();
        return response()->json(['data' => $abouts]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
            'head' => 'required',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        try {
            // Create a new instance of the "About" model
            $about = new About();
            $about->title = $request->input('title');
            $about->description = $request->input('description');
            $about->head = $request->input('head');
            $about->save();

            // Check if images were uploaded and attach them to the "photos" collection
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $media = $about->addMedia($image)->toMediaCollection('photos');
                    $imageUrls[] = $media->getFullUrl(); // Get the full URL of the uploaded image
                }
            }

            return response()->json([
                'message' => 'About created successfully.',
                'data' => $about,
                'image_urls' => $imageUrls ?? [], // Return empty array if no images were uploaded
            ], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'File upload error: ' . $e->getMessage()], 500);
        }
    }

    public function show($id)
    {
        $about = About::with('media')->find($id);

        if (!$about) {
            return response()->json(['error' => 'About not found.'], 404);
        }

        return response()->json(['data' => $about]);
    }

    public function update(Request $request, $id)
    {
        $about = About::find($id);

        if (!$about) {
            return response()->json(['error' => 'About not found.'], 404);
        }

        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
            'head' => 'required',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        // Remove existing images

        // Update the about record
        $about->update($request->all());

        // Add new images
        if ($request->hasFile('images')) {
            $about->clearMediaCollection('images');
            foreach ($request->file('images') as $image) {
                $about->addMedia($image)->toMediaCollection('images');
            }
        }

        return response()->json(['message' => 'About updated successfully.', 'data' => $about], 200);
    }


    public function destroy($id)
    {
        $about = About::find($id);

        if (!$about) {
            return response()->json(['error' => 'About not found.'], 404);
        }

        $about->delete();
        return response()->json(['message' => 'About deleted successfully.'], 204);
    }
}
