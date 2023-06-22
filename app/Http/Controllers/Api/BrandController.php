<?php

namespace App\Http\Controllers\Api;

use App\Models\Shop\Brand;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Actions\Brand\BrandListAction;
use App\Actions\Brand\BrandShowAction;
use App\Actions\Brand\BrandCreateAction;
use App\Actions\Brand\BrandUpdateAction;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return response()->json((new BrandListAction())->execute($request->all()), Response::HTTP_PARTIAL_CONTENT);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $brand = (new BrandCreateAction())->execute($request->all());
            return response()->json($brand, Response::HTTP_CREATED);
        } catch (Exception $e) {
            return response()->json(
                ['message' => $e->getMessage(), 'errors' => $e->errors()]
            );
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand)
    {
        try {
            $brand = (new BrandShowAction())->execute($brand);
            return response()->json($brand, Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json(
                ['message' => $e->getMessage(), 'errors' => $e->errors()]
            );
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Brand $brand)
    {
        try {
            $brand = (new BrandUpdateAction($brand))->execute($request->all());
            return response()->json($brand, Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json(
                ['message' => $e->getMessage(), 'errors' => $e->errors()]
            );
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand)
    {
        $brand->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
