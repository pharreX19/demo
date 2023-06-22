<?php

namespace App\Http\Controllers\Api;

use App\Actions\Customer\CustomerCreateAction;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Actions\Customer\CustomerListAction;
use App\Actions\Customer\CustomerShowAction;
use App\Actions\Customer\CustomerUpdateAction;
use App\Models\Shop\Customer;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return response()->json((new CustomerListAction())->execute($request->all()), Response::HTTP_PARTIAL_CONTENT);
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
            $brand = (new CustomerCreateAction())->execute($request->all());
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
    public function show(Customer $customer)
    {
        try {
            $brand = (new CustomerShowAction())->execute($customer);
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
    public function update(Request $request, Customer $customer)
    {
        try {
            $brand = (new CustomerUpdateAction($customer))->execute($request->all());
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
    public function destroy(Customer $customer)
    {
        $customer->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
