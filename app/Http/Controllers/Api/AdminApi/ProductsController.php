<?php

namespace App\Http\Controllers\Api\AdminApi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\ProductRepository;

class ProductsController extends Controller
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

    public function search(Request $request, ProductRepository $productRepository)
    {
        return $productRepository->getSearch($request->name);
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
    public function store(Request $request, ProductRepository $productRepository)
    {
        $validator = validator($request->all(),
            [
                'collection_id' => 'required',
                'name' => 'required',
                'desc' => 'required',
                'img' => 'required',
                'price'=>'required',
            ]
        );
        if(!$validator->fails() ){
            return $productRepository->addNewProduct($request->collection_id,$request->name,$request->desc,$request->img,$request->price);
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
    public function show($id, ProductRepository $productRepository)
    {
        return $productRepository->getAllInfoById($id);
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
    public function update(Request $request, $id, ProductRepository $productRepository)
    {
        return $productRepository->updateProduct($id, $request->collection_id, $request->name, $request->desc, $request->img, $request->price);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductRepository $productRepository, $id)
    {
        $productRepository->dellProduct($id);
    }
}
