<?php

namespace App\Repositories;

use App\Repositories\Contracts\ProductRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Product;

class ProductRepository implements ProductRepositoryInterface
{
    protected $entity;

    public function __construct(Product $product)
    {
        $this->entity = $product;
    }

    /**
     * Get all Products
     * @return array
     */
    public function getAllProducts()
    {
        return $this->entity->all();
    }


    /**
     * Get all highlight Products
     * @return array
     */
    public function getAllHighlightProducts()
    {
        return $this->entity->highlight();
    }

    /**
     * Select Product by ID
     * @param int $id
     * @return object
     */
    public function getProductById($id)
    {
        return $this->entity->find($id);
    }

     /**
     * Get Products by Brand id
     * @return array
     */
    public function getProductsByBrandId($brandId)
    {
        return $this->entity
            ->where('status','S')
            ->where("current_stock", ">", 0)
            ->where("brand_id", $brandId)
            ->paginate(12);
    }


     /**
     * Get Products by Category id
     * @return array
     */
    public function getProductsByCategoryId($categoryId)
    {
        return $this->entity->where("category_id", $categoryId)->paginate(12);
    }


    /**
     * Get Products in a list of categories
     * @return array
     */
    public function getProductsInCategories($categories)
    {
        return $this->entity
            ->where('status','S')
            ->where("current_stock", ">", 0)
            ->whereIn("category_id", $categories)->paginate(12);
    }

     /**
     * Get Product by Permalink
     * @return array
     */
    public function getProductByPermalink($permalink)
    {
        return $this->entity->where("permalink", $permalink)->firstOrFail();
    }

    /**
     * Get Products by Permalink
     * @return array
     */
    public function getProductsByKeyword($keyword)
    {
        return $this->entity
            ->select([
            'products.*',
            ])
            ->with(['category', 'brand', 'photos'])
            ->where("products.status", 'S')
            ->where("current_stock", ">", 0)
            ->where(function (Builder $query) use($keyword){
                $query
                    ->orWhereLike('products.name',  "%$keyword%")
                    ->orWhereLike('products.description',  "%$keyword%")
                    ->orWhereLike('products.text',  "%$keyword%")
                    ->whereLike('categories.name',  "%$keyword%")
                    ->orWhereLike('brands.name',  "%$keyword%")
                    ->orWhere('products.code',  "$keyword");
            })
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->join('brands', 'products.brand_id', '=', 'brands.id')
            ->orderBy('products.name')
            ->paginate(12);
    }

     /**
     * Get Product by News
     * @return array
     */
    public function getProductsByNews()
    {
        return $this->entity
            ->where("products.status", 'S')
            ->where("current_stock", ">", 0)
            ->where("news", "S")
             ->orderBy('products.name')
            ->paginate(12);
    }

    public function createProduct(array $data)
    {
         return $this->entity->create($data);
    }

    /**
     * Update data of Product
     * @param object $Product
     * @param array $data
     * @return object
     */
    public function updateProduct(Product $product, array $data)
    {
        return $product->update($data);
    }


    /* Delete a Product
     * @param object $Category
     */
    public function destroyProduct(Product $product)
    {
        return $product->delete();
    }
}
