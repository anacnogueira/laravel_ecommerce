<?php

namespace App\Services;

use App\Repositories\Contracts\ProductRepositoryInterface;
use Illuminate\Support\Str;
use App\Services\ProductPhotoService;

class ProductService
{
    protected $productRepository;
    protected $productPhotoService;

    public function __construct(
        ProductRepositoryInterface $productRepository,
        ProductPhotoService $productPhotoService
        )
    {
        $this->productRepository = $productRepository;
        $this->productPhotoService = $productPhotoService;

    }

    /**
     * list all products
     * @return array
    */
    public function getAllProducts()
    {
        return $this->productRepository->getAllProducts();
    }

    /**
     * list all highlight products
     * @return array
    */
    public function getAllHighlightProducts()
    {
        return $this->productRepository->getAllHighlightProducts();
    }


    /**
     * Get Product by  ID
     * @param int $id
     * @return object
    */
    public function getProductById(int $id)
    {
        return $this->productRepository->getProductById($id);
    }

    /**
     * list products by brand id
     * @return array
    */
    public function getProductsByBrandId($brandId)
    {
        $products = $this->productRepository->getProductsByBrandId($brandId);
        foreach ($products as $i => $product) {
            $products[$i]->categories = $product->category->ancestors($product->category_id);
        }
        return $products;
    }

    /**
     * list products by category id
     * @return array
    */
    public function getProductsByCategoryId($categoryId)
    {
        $products = $this->productRepository->getProductsbyCategoryId($categoryId);
        foreach ($products as $i => $product) {
            $products[$i]->categories = $product->category->ancestors($product->category_id);
        }
        return $products;
    }


    /**
     * list products in a list of categories
     * @return array
    */
    public function getProductsInCategories($categories)
    {
        $products = $this->productRepository->getProductsInCategories($categories);
        foreach ($products as $i => $product) {
            $products[$i]->categories = $product->category->ancestors($product->category_id);
        }
        return $products;
    }


    public function getProductByPermalink($permalink)
    {
        return $this->productRepository->getProductByPermalink($permalink);
    }

    public function getProductsByKeyword($keyword)
    {
        $products = $this->productRepository->getProductsByKeyword($keyword);

        foreach ($products as $i => $product) {
            $products[$i]->categories = $product->category->ancestors($product->category_id);
        }

         return $products;
    }

    /**
     * list products by news
     * @return array
    */

    public function getProductsByNews()
    {
        $products =  $this->productRepository->getProductsByNews();

        foreach ($products as $i => $product) {
            $products[$i]->categories = $product->category->ancestors($product->category_id);
        }

        return $products;
    }

    /* Create a new Product
     * @param array $data
     * @return object
    */
    public function makeProduct(array $data)
    {
        if (empty($data['meta_title'])) {
            $data['meta_title'] = $data['name'];
        }

        $data["permalink"] = Str::slug($data["meta_title"],'-');
        $data["permalink_old"] = Str::slug($data["meta_title"],'-');

        $product = $this->productRepository->createProduct($data);
        $productId = $product->id;

        if (isset($data['files'])) {
            foreach ($data['files'] as $key => $file) {
                if ($file->isValid()) {
                    $filename = $data["permalink"].'-'.$productId.'-'.($key+1).'-'.time();
                    $order = $data['order'][$key];
                    $extension = $file->extension();
                    $this->productPhotoService->makeProductPhoto($productId, $file, $filename, $extension, $order);

                }
            }
        }

        return $product;
    }

    public function updateProduct(int $id, array $data)
    {
        $product = $this->productRepository->getProductById($id);

        if (!$product) {
            return response()->json(['message' => 'Product Not Found'], 404);
        }

        if (empty($data['meta_title'])) {
            $data['meta_title'] = $data['name'];
        }

        $data["permalink"] = Str::slug($data["meta_title"],'-');
        $data["permalink_old"] = Str::slug($data["meta_title"],'-');

        $this->productRepository->updateProduct($product, $data);

        $productId = $product->id;
        if (isset($data['files'])) {
            foreach ($data['files'] as $key => $file) {
                if ($file->isValid()) {
                    $filename = $data["permalink"].'-'.$productId.'-'.($key+1).'-'.time();
                    $order = $data['order'][$key];
                    $extension = $file->extension();
                    if (isset($data['photo_ori'][$key]) && $data['photo_redim'][$key]) {
                        $oldFiles['photo_ori'] = $data['photo_ori'][$key];
                        $oldFiles['photo_redim'] = $data['photo_redim'][$key];
                    } else {
                        $oldFiles = null;
                    }

                    $this->productPhotoService->updateProductPhoto($productId, $file, $filename, $extension, $order, $oldFiles);
                }
            }
        }


        return response()->json(['message' => 'Product Updated'], 200);
    }

    /**
     * Delete a Product
     * @param int $id
     * @return json response
    */
    public function destroyProduct(int $id)
    {
        $product = $this->productRepository->getProductById($id);

        if (!$product) {
            return response()->json(['message' => 'Product Not Found'], 404);
        }

        //Delete Product Photos
        $productPhotos = $this->productPhotoService->deleteProductPhotosByProductId($id);

        $this->productRepository->destroyProduct($product);

        return response()->json(['message' => 'Product Deleted'], 200);
    }

    public function getProductsToSelect()
    {
        $select = new \stdClass();
        $select->id = null;
        $select->name = "Selecione o produto";

        $products = $this->getAllProducts()
            ->sortBy('name')
            ->prepend($select);

        return $products;
    }



}
