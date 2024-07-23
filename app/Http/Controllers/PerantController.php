<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use App\Models\Perant;
use Illuminate\Http\Request;

class PerantController {
    /**
    * Display a listing of the resource.
    */

    public function index() {
        $perant = Perant::with( 'media' )->get();
        return response()->json(
            [
                'perents' => $perant
            ]
        );
    }

    /**
    * Show the form for creating a new resource.
    */

    public function create() {
        //
    }

    /**
    * Store a newly created resource in storage.
    */

    public function store( Request $request ) {

        $perant = new Perant();
        $perant->setTranslation( 'title', 'en', $request->title_en );
        $perant->setTranslation( 'title', 'ar', $request->title_ar );
        if ( $request->hasFile( 'image' ) ) {
            $perant->addMedia( $request->file( 'image' ) )->toMediaCollection( 'perent' );
        }
        $perant->save();
        return $perant;
    }

    /**
    * Display the specified resource.
    */

 public function show($id)
{
    try {
        $perant = Perant::with(['categorys.media'])->findOrFail($id);
        return response()->json(['perant' => $perant], 200);
    } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
        return response()->json(['error' => 'Perant not found'], 404);
    }
}

   public function update(Request $request,  $id) {
        $perant = Perant::find($id);
    // Validation - You might want to add validation logic here
    // Update Perant model with translated titles
      $perant->setTranslation( 'title', 'en', $request->title_en );
        $perant->setTranslation( 'title', 'ar', $request->title_ar );
  
    // Update image if provided
    if ($request->hasFile('image')) {
        $perant->clearMediaCollection('perent'); // Clear existing media in the 'perent' collection
        $perant->addMedia($request->file('image'))->toMediaCollection('perent');
    }

    // Save the updated Perant model
    $perant->save();
return $request->all();
    // Return JSON response with updated Perant and success message
    return response()->json(['perant' => $perant, 'message' => 'Perant updated successfully'], 200);
}


    public function destroy( $perant ) {
        $perant = Perant::find( $perant );
        $perant->delete();
        return response()->json( [
            'status' => 200,
            'message' => 'Perant Deleted Successfully',
        ] );
    }
}
