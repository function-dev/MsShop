<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\CookieCartRepository;

class CookieController extends Controller
{
    public function addCookie(Request $request){
//        $data = [
//            'id'=>'2',
//            'size'=>'3',
//            'price'=>'4',
//            'quantity'=>'1'
//        ];
        $data = '[{"id":1,"name":"Sprint 2020","created_at":"2021-03-02T17:01:42.000000Z","updated_at":"2021-03-02T17:01:42.000000Z"}';


        if (!empty($request->session()->get('cart'))){
            $sab = substr($request->session()->get('cart'), 0, -1);
//            array_push($data, $request->session()->get('cart'));
            $data = $data .','.substr($sab,1);
            dd(json_decode($data));

        }

        $request->session()->put('cart', $data . ']');
        return $request->session()->get('cart');
    }
    public function getCookie(Request $request){

    }
}
