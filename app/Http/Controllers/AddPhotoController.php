<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AddPhotoController extends Controller
{
    public function add(Request $request){
        $path = $request->file('files')->store('img/product', 'public');
//        return redirect(route('admin.add'), [
//            'productImage'=>$path
//        ]);
        return $path;
    }
}
