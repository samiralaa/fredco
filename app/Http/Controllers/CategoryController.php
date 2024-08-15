<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController
{
    /**
     * Display a listing of the resource.
     */

    public function getAllCategories()
    {
        $categories = Category::with('media', 'projects.media')->get();
        return response()->json(
            [
                'categories' => $categories,
            ]
        );
    }
    public function latestCategory($id)
    {
        $category = Category::with(['media', 'projects.media'])->find($id);

        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }

        return response()->json([
            'category' => $category,
            'media' => $category->projects(with('media')),
        ]);
    }
    public function store(Request $request) {
        $category = new Category();
        $category->title = $request->title;
        $category->rate = $request->rate;
        $category->description = $request->description; // Add description
    
        if ($request->hasFile('image')) {
            $category->addMediaFromRequest('image')
                ->toMediaCollection('category');
        }
    
        $category->save();
        return $category;
    }
    
    public function update(Request $request, $id)
    {
        $category = Category::find($id);
        if (!$category) {
            return response()->json(['error' => 'Category not found'], 404);
        }
    
        $category->title = $request->title;
        $category->description = $request->description; // Update description
    
        if ($request->hasFile('image')) {
            $category->clearMediaCollection('category');
            $category->addMedia($request->file('image'))->toMediaCollection('category');
        }
    
        $category->save();
        return response()->json(['message' => 'Category updated successfully', 'category' => $category], 200);
    }
    

    public function show($id)
    {
        $category = Category::with(['media', 'projects.media'])->find($id);
        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }

        return response()->json([
            'category' => $category,

        ]);
    }

  

    public function destroy($category)
    {
        $category = Category::findOrFail($category);
        
        // Delete all projects related to this category
        $category->projects()->delete();
        
        // Now delete the category
        $category->delete();
    
        return response()->json(['message' => 'Category deleted successfully'], 200);
    }
    
}
