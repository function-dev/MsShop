<?php

namespace App\Http\Controllers\Api\AdminApi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\OrdersProductRepository;
use App\Repositories\QuantityRepository;

class OrdersProductController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, OrdersProductRepository $ordersProductRepository, QuantityRepository $quantityRepository)
    {
        $validator = validator($request->all(),
            [
                'order_id' => 'required',
                'product_id' => 'required',
                'quantity' => 'required',
                'price' => 'required',
            ]
        );

        if(!$validator->fails() ){
            $quantityRepository->lineChangesByTooColumns('product_id', $request->product_id, 'size', $request->size, 'quantity', $request->quantity);
            return $ordersProductRepository->addNewOrderProduct($request->order_id, $request->product_id, $request->quantity, $request->price, $request->size);
        }

        return response()
            ->json($validator->errors())
            ->setStatusCode(400, 'Bad Request');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, OrdersProductRepository $ordersProductRepository)
    {
        return $ordersProductRepository->getOrderByOrderId($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
