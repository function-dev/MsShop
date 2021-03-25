<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){

        return view('admin/index');
    }
    public function catalog(){

        return view('admin/catalog');
    }
    public function collection(){

        return view('admin/collection');
    }
    public function addProduct(){

        return view('admin/addProduct');
    }
    public function addCollection(){

        return view('admin/addCollection');
    }
    public function editCollection($id){

        return view('admin/editCollection', ['id' => $id]);
    }
    public function editProduct($id){

        return view('admin/editProduct', ['id' => $id]);
    }
}
