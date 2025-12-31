<?php

namespace App\Repositories\Contracts;

use App\Models\Product;

interface ProductRepositoryInterface
{
    public function getAllHighlightProducts();
    public function getAllProducts();
    public function getProductById($id);
    public function getProductsByKeyword($keyword);
    public function createProduct(array $data);

}
