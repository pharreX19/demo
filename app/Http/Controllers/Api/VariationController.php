<?php

namespace App\Http\Controllers\Api;

use App\Models\Variation;
use App\Models\Shop\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Actions\Variation\VariationCreateAction;

class VariationController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Product $product)
    {
        try {
            $brand = (new VariationCreateAction())->execute($product, $request->all());
            return response()->json($brand, Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json(
                ['message' => $e->getMessage(), 'errors' => $e->errors()]
            );
        }
    }
}
