<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController {
    /**
    * Display a listing of the resource.
    */

    public function index() {

        $product = Product::with( 'media' )->get();

        return response()->json( [
            'status' => 'success', 'message' => 'Project updated successfully',
            'product' => $product
        ] );
    }

    public function latestproducts() {

        $projects = Product::with( 'media' )
        ->latest( 'created_at' )
        ->take( 3 )
        ->get();
        return response()->json( [ 'projects' => $projects ] );
    }

    public function store(Request $request) {
        $product = new Product();
        // Assuming single language fields
        $product->title = $request->title;
        $product->description = $request->description;
        $product->scope = $request->scope;
        $product->price = $request->price;
        $product->refcode = $request->refcode;
    
        // Check if images are uploaded
        if ($request->hasFile('image')) {
            $images = $request->file('image');
            foreach ($images as $image) {
                // Store each image
                $product->addMedia($image)
                    ->toMediaCollection('product');
            }
        }
    
        $product->save();
    
        // Return a response
        return response()->json([
            'success' => true,
            'message' => 'Product created successfully.',
            'product' => $product,
        ]);
    }
    

    public function show( $id ) {
        // Validate $id parameter

        // Retrieve product by ID with associated media
        $product = Product::where( 'id', $id )->with( 'media' )->first();

        // Check if product exists
        if ( !$product ) {
            return response()->json( [ 'status' => 'error', 'message' => 'Product not found' ], 404 );
        }

        // Return success response with product data
        return response()->json( [ 'status' => 'success', 'product' => $product ], 200 );
    }

    public function update( Request $request, Product $product ) {
        $product->setTranslation( 'title', 'en', $request->title_en );
        $product->setTranslation( 'title', 'ar', $request->title_ar );
        $product->setTranslation( 'description', 'en', $request->description_en );
        $product->setTranslation( 'description', 'ar', $request->description_ar );
        $product->scope = $request->scope;
        $product->price = $request->price;
        $product->refcode = $request->refcode;

        if ( $request->hasFile( 'image' ) ) {
            $product->clearMediaCollection( 'projects' );
            // Remove existing media from the collection
            $product->addMediaFromRequest( 'image' )
            ->toMediaCollection( 'product' );
        }

        $product->save();
        return $product;
    }

    /**
    * Remove the specified resource from storage.
    */

    public function destroy( Product $product ) {
        $product->delete();
        return response()->json( [ 'message' => 'Project deleted successfully' ] );
    }

    public function newvidoestore( Request $request ) {
        $product = new Product();
        $product->setTranslation( 'title', 'en', $request->title_en );
        $product->setTranslation( 'title', 'ar', $request->title_ar );
        $product->setTranslation( 'description', 'en', $request->description_en );
        $product->setTranslation( 'description', 'ar', $request->description_ar );
        $product->scope = $request->scope;
        $product->price = $request->price;
        $product->refcode = $request->refcode;
        $product->link = $request->link;

        // Check if images are uploaded
        if ( $request->hasFile( 'image' ) ) {
            $images = $request->file( 'image' );
            foreach ( $images as $image ) {
                // Store each image
                $mediaItem = $product->addMedia( $image )
                ->toMediaCollection( 'product' );
            }
        }

        $product->save();

        // Return a response
        return response()->json( [
            'success' => true,
            'message' => 'Product created successfully.',
            'product' => $product,
        ] );
    }

    public function getnewvidoestore() {
    }
}
