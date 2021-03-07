<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class AdminController extends Controller
{
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
}
