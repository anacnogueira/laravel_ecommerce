<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\ProductService;
use App\Services\SupplierService;
use App\Services\BrandService;
use App\Services\CategoryService;
use App\Http\Requests\AdminStoreUpdateProductRequest;

class ProductController extends Controller
{
    protected $productService;
    protected $supplierService;
    protected $brandService;
    protected $categoryService;
    protected $origins;

    public function __construct(
        ProductService $productService,
        SupplierService $supplierService,
        BrandService $brandService,
        CategoryService $categoryService,
    )
    {
        $this->productService = $productService;
        $this->supplierService = $supplierService;
        $this->brandService = $brandService;
        $this->categoryService = $categoryService;
        $this->origins = [
            "0 - Nacional, exceto as indicadas nos códigos 3 a 5",
            "1 - Estrangeira - Importação direta, exceto a indicada no código 6",
            "2 - Estrangeira - Adquirida no mercado interno, exceto a indicada no código 7",
            "3 - Nacional, mercadoria ou bem com Conteúdo de Importação superior a 40% e inferior ou igual a 70%",
            "4 - Nacional, cuja produção tenha sido feita em conformidade com os processos produtivos básicos de que tratam as legislações citadas nos Ajustes",
            "5 - Nacional, mercadoria ou bem com Conteúdo de Importação inferior ou igual a 40%",
            "6 - Estrangeira - Importação direta, sem similar nacional, constante em lista da CAMEX",
            "7 - Estrangeira - Adquirida no mercado interno, sem similar nacional, constante em lista da CAMEX",
            "8 - Nacional, mercadoria ou bem com Conteúdo de Importação superior a 70%",
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = $this->productService->getAllProducts();

        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $product = null;

        $suppliers = $this->getSuppliers();
        $brands = $this->getBrands();
        $categories = $this->getCategories();
        $origins = $this->origins;

        return view('admin.products.create', compact('product', 'suppliers', 'brands', 'categories', 'origins'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdminStoreUpdateProductRequest $request)
    {

        $data = $request->all();

        $product= $this->productService->makeProduct($data);

        return redirect()->route('admin.products.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = $this->productService->getProductById($id);
        $product->origin = $this->origins[$product->origin];
        $product->highlight = $product->highlight == 'S' ? 'Sim' : 'Não';
        $product->news = $product->news == 'S' ? 'Sim' : 'Não';
        $product->status = $product->status == 'S' ? 'Em estoque' : 'Fora de estoque';

        return view('admin.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
       $product = $this->productService->getProductById($id);
       $suppliers = $this->getSuppliers();
       $brands = $this->getBrands();
       $categories = $this->getCategories();
       $origins = $this->origins;

       return view('admin.products.edit', compact('product', 'suppliers', 'brands', 'categories', 'origins'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdminStoreUpdateProductRequest $request, string $id)
    {
        $data = $request->all();

        $category = $this->productService->updateProduct($id, $data);

        return redirect()->route('admin.products.index');
    }

    public function duplicate(string $id)
    {
        $product = $this->productService->getProductById($id);

        $suppliers = $this->getSuppliers();
        $brands = $this->getBrands();
        $categories = $this->getCategories();
        $origins = $this->origins;

        return view('admin.products.create', compact('product', 'suppliers', 'brands', 'categories', 'origins'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = $this->productService->destroyProduct($id);

        return redirect()->route('admin.products.index');
    }

    private function getSuppliers()
    {
        $select = new \stdClass();
        $select->id = null;
        $select->fantasy_name = "Selecione";

        return $this->supplierService->getAllSuppliers()
            ->sortBy('fantasy_name')
            ->prepend($select);
    }

    private function getBrands()
    {
        $select = new \stdClass();
        $select->id = null;
        $select->name = "Selecione";

        return $this->brandService->getAllBrands()
            ->sortBy('name')
            ->prepend($select);
    }

    private function getCategories()
    {
        $select = new \stdClass();
        $select->id = null;
        $select->name = "Selecione";

        return $this->categoryService->getAllCategories()
            ->sortBy('name')
            ->prepend($select);
    }
}
