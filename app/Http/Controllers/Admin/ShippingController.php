<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\ShippingService;
use App\Services\StateService;
use App\Services\CityService;
use App\Services\ProductService;
use App\Http\Requests\AdminStoreUpdateShippingRequest;

class ShippingController extends Controller
{
    protected $shippingService;
    protected $stateService;
    protected $cityService;
    protected $productService;

    public function __construct(
        ShippingService $shippingService,
        StateService $stateService,
        CityService $cityService,
        ProductService $productService
        )
    {
        $this->shippingService = $shippingService;
        $this->stateService = $stateService;
        $this->cityService = $cityService;
        $this->productService = $productService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shippings = $this->shippingService->getAllShippings();

        return view('admin.shippings.index', compact('shippings'));
    }

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $shipping = null;

        $states = $this->stateService->getStatesToSelect();
        $cities = $this->cityService->getCitiesToSelect();
        $products = $this->productService->getProductsToSelect();

        return view('admin.shippings.create', compact('shipping','states', 'cities','products'));
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminStoreUpdateShippingRequest $request)
    {
        $data = $request->all();

        $shipping = $this->shippingService->makeShipping($data);

        return redirect()->route('admin.shippings.index');
    }

     /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $shipping = $this->shippingService->getShippingById($id);
        $shipping->status = $shipping->status === 'S' ? 'Ativo' : ' Inativo';

        return view('admin.shippings.show', compact('shipping'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $shipping = $this->shippingService->getShippingById($id);
        $states = $this->stateService->getStatesToSelect();
        $cities = $this->cityService->getCitiesToSelect();
        $products = $this->productService->getProductsToSelect();

        return view('admin.shippings.edit', compact('shipping','states', 'cities','products'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdminStoreUpdateShippingRequest $request, $id)
    {
        $data = $request->all();

        $shipping = $this->shippingService->updateShipping($id, $data);

        return redirect()->route('admin.shippings.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $shipping = $this->shippingService->destroyShipping($id);

        return redirect()->route('admin.shippings.index');
    }
}
