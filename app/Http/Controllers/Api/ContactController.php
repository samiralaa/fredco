<?php

namespace App\Http\Controllers\Api;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Requests\ProjectRequest;

class ContactController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Contact::paginate(10);
        return response()->json([
            'contact'=>$data
        ]);
    }

    public function store(Request $request)
    {

       $date = Contact::create($request->all());

        if ($request->hasFile('image')) {
            $date->addMediaFromRequest('image')
                ->toMediaCollection('images'); // 'images' is the collection name
        }
       return response()->json([
           'message'=>'data inserted successfully',
           'data'=>$date,
           'status'=>200


       ]);

    }
    public function show(Contact $contact)
    {

    }
    public function destroy( $contact)
    {
        $data= Contact::find($contact);
        $data->delete();
        return response()->json([
            'message'=>'data deleted successfully',
            'status'=>200
        ]);
    }
}
