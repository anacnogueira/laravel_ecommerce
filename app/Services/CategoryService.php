<?php

namespace App\Services;

use App\Repositories\Contracts\CategoryRepositoryInterface;
use Illuminate\Support\Str;
use App\Services\StoreFileService;
use App\Services\DeleteFileService;

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
    public function makeCategory(array $data)
    {
        $data["status"] = isset($data["status"]) ? 'S' : 'N';
        $data["permalink"] = Str::slug($data["name"]);
        $data["permalink_old"] = Str::slug($data["name"]);

        $category = $this->categoryRepository->createCategory($data);

        if ($data["upload"]) {
            $filename = Str::slug($category->name)."-".date('dmYHis');
            $pathFile = $this->storeImage($data["upload"], $filename);

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
    public function updateCategory(int $id, array $data)
    {
        $category = $this->categoryRepository->getCategoryById($id);

        if (!$category) {
            return response()->json(['message' => 'Category Not Found'], 404);
        }

        $data["status"] = isset($data["status"]) ? 'S' : 'N';

        if (isset($data["upload"])) {
            $oldFile = $category->image;
            $filename = Str::slug($data["name"])."-".date('dmYHis');
            $pathFile = $this->storeImage($data["upload"], $filename, $oldFile);

            $data["image"] = $pathFile;
        }

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

        if ($category->image) {
            DeleteFileService::delete($category->image);
        }

        $this->categoryRepository->destroyCategory($category);

        return response()->json(['message' => 'category Deleted'], 200);
    }

    public function getChildrenCategories(int $id)
    {
        $categories[] = $id;

        $data = $this->categoryRepository->getCategoryByParentId($id);

        foreach ($data as $item){
            $categories = array_merge($categories, $this->getChildrenCategories($item->id));
        }

        return $categories;
    }

    private function storeImage($file, $filename, $oldFile = null)
    {
        if ($oldFile) {
            DeleteFileService::delete($oldFile);
        }

        $storeFileService = new StoreFileService(
            $file,
            env('FILE_DESTINATION_CATEGORIES'),
            $filename
        );
        $pathFile = $storeFileService->upload();

        return $pathFile;
    }
}
