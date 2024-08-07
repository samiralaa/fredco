<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Requests\ProjectRequest;
use Illuminate\Support\Facades\DB;

class ProjectController {
    /**
    * Display a listing of the resource.
    */
public function totalProject  ()
{
    return response()->json([
        'total'=> DB::table('projects')->count(),
    ]);
}
    public function index() {
        $project = Project::with( 'media', 'category' )->get();
        return response()->json(
            [
                'projects' => $project
            ]
        );
    }

    public function latestProject() {
         $projects = Project::with(['media', 'category'])
        ->latest('created_at')
        ->take(3)
        ->get();
    return response()->json(['projects' => $projects]);
    }

    public function store(Request $request) {
        $project = new Project();
    
        // Set single language fields
        $project->title = $request->title;
        $project->description = $request->description;
        $project->location = $request->location;
        $project->scope = $request->scope;
        $project->link = $request->link;
        $project->category_id = $request->category_id;
    
        // Handle multiple file uploads
        if ($request->hasFile('images')) {
            $images = $request->file('images');
            foreach ($images as $image) {
                // Store each image
                $project->addMedia($image)
                    ->toMediaCollection('projects'); // 'projects' is the collection name
            }
        }
    
        $project->save();
    
        // Return a response
        return response()->json([
            'success' => true,
            'message' => 'Project created successfully.',
            'project' => $project,
        ]);
    }
    

    public function show( $id ) {
        $project = Project::with( 'category' ,'media')->find($id);

        if ( !$project ) {
            return response()->json( [ 'status' => 'error', 'message' => 'Project not found' ], 404 );
        }

        return response()->json( [ 'status' => 'success', 'project' => $project ], 200 );
    }

    public function update(Request $request, $id) {
        $project = Project::findOrFail($id);
        
        // Update single language fields
        $project->title = $request->title;
        $project->description = $request->description;
        $project->location = $request->location;
        $project->scope = $request->scope;
        $project->link = $request->link;
        $project->category_id = $request->category_id;
        
        // Handle multiple file uploads
        if ($request->hasFile('images')) {
            // Optionally, remove old images if needed
             $project->clearMediaCollection('projects');
            
            $images = $request->file('images');
            foreach ($images as $image) {
                // Store each image
                $project->addMedia($image)
                    ->toMediaCollection('projects'); // 'projects' is the collection name
            }
        }
        
        $project->save();
        
        // Return a response
        return response()->json([
            'success' => true,
            'message' => 'Project updated successfully.',
            'project' => $project,
        ]);
    }
    


    public function destroy(  $project ) {
            $project = Project::find($project);
        $project->delete();
        return response()->json( [ 'message' => 'Project deleted successfully' ] );
    }
}
