<?php

namespace App\Repositories;

use App\Repositories\Contracts\CategoryRepositoryInterface;
use App\Models\Category;

class CategoryRepository implements CategoryRepositoryInterface
{
    protected $entity;

    public function __construct(Category $Category)
    {
        $this->entity = $Category;
    }

    /**
     * Get all Categorys
     * @return array
     */
    public function getAllCategories()
    {
        return $this->entity->all();
    }

    /**
     * Mount categories for menu
     * @return array
     */
    public function getCategoriesForMenu()
    {
        return $this->entity->tree();
    }

    /**
     * Select Category by ID
     * @param int $id
     * @return object
     */
    public function getCategoryById($id)
    {
        return $this->entity->find($id);
    }

     /**
     * Select Category by Permalink
     * @param string $permalink
     * @return object
     */
    public function getCategoryByPermalink($permalink)
    {
        return $this->entity->where('permalink', $permalink)->first();
    }

    /**
     * Create a new Category
     * @param array $data
     * @return object
     */
    public function createCategory(array $data)
    {
        return $this->entity->create($data);
    }

     /**
     * Update data of Category
     * @param object $Category
     * @param array $data
     * @return object
     */
    public function updateCategory(Category $category, array $data)
    {
        return $category->update($data);
    }

    /**
     * Delete a Category
     * @param object $Category
     */
    public function destroyCategory(Category $category) 
    {
        return $category->delete();
    }
}