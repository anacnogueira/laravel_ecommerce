<?php

namespace App\Services;

use App\Repositories\Contracts\CategoryRepositoryInterface;
use App\Services\StoreFileService;
use Illuminate\Support\Str;

class CategoryService
{
    protected $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Select all Categories
     * @return array
    */
    public function getAllCategories()
    {
        return $this->categoryRepository->getAllCategories();
    }    

     /**
     * Create a new Category
     * @param array $data
     * @return object 
    */
    public function makeCategory(array $data, $file)
    {
        $data["status"] = isset($data["status"]) ? 'S' : 'N';
        $data["permalink"] = Str::kebab($data["name"]);

        $category = $this->categoryRepository->createCategory($data);

        $fileName = Str::kebab($category->name)."-".date('dmYHis');

        if ($file) {
            $storeFileService = new StoreFileService(
                $file,
                "public/images/categories",
                $fileName
            );
            $pathFile = $storeFileService->upload();
            $category->update([
                "image" => $pathFile,
            ]);
        }        

        return $category;
    }

    /**
     * Get Category by  ID
     * @param int $id
     * @return object
    */
    public function getCategoryById(int $id)
    {
        return $this->categoryRepository->getCategoryById($id);
    }

    /**
     * Get Category by  Permalink
     * @param string $permalink
     * @return object
    */
    public function getCategoryByPermalink(string $permalink)
    {
        return $this->categoryRepository->getCategoryByPermalink($permalink);
    }

    /**
     * Update a Category
     * @param int $id
     * @param arrray $data
     * @return json response
    */
    public function updateCategory(int $id, array $data, $file)
    {
        $category = $this->categoryRepository->getCategoryById($id);

        if (!$cCategory) {
            return response()->json(['message' => 'Category Not Found'], 404);
        }

        $data["status"] = isset($data["status"]) ? 'S' : 'N';        

        //To Do: Update image

        $this->categoryRepository->updateCategory($category, $data);
        return response()->json(['message' => 'Category Updated'], 200);
    }

    /**
     * Delete a Category
     * @param int $id
     * @return json response
    */
    public function destroyCategory(int $id)
    {
        $category = $this->categoryRepository->getCategoryById($id);

        if (!$category) {
            return response()->json(['message' => 'Category Not Found'], 404);
        }

        $this->categoryRepository->destroyCategory($category);

        return response()->json(['message' => 'category Deleted'], 200);
    }
}