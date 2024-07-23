<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\House;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
   use Alkoumi\LaravelHijriDate\Hijri;
use App\Http\Requests\UpdateUserRequest;

class ProfileController extends Controller
{
    function index()
    {
        $user = Auth::user()->id;

        $date =User::where('id',$user)->with('houses.documents')->get();
        return response()->json($date);
    }
    function update(Request $request)
    {
        $user = Auth::user()->id;

        if(!$user){
            return response()->json(['notFound'=>'المستخدم غير موجود'],404);
        }
        $imageName=Auth::user()->image;
        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images'), $imageName);
        }
        $profile = User::where('id', $user)->first();
        $profile->update([
            'first_name'=>$request->first_name,
            'last_name'=>$request->last_name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'image'=>$imageName,
            'password'=>$request->password
        ]);
        $new_data =User::find(Auth::user()->id);
        return response()->json(['success'=>'تم حذف المستخدم بنجاح',
        "user"=>$new_data,

],202);

    }
    public function destroy($id){
        $user = User::where('id',$id)->first();
        $user->delete();
        return response()->json(['success'=>'تم حذف المستخدم بنجاح'],202);
    }
}
