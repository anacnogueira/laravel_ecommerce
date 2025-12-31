<?php

namespace App\Repositories;

use App\Repositories\Contracts\PageRepositoryInterface;
use App\Models\Page;

class PageRepository implements PageRepositoryInterface
{
    protected $entity;

    public function __construct(Page $page)
    {
        $this->entity = $page;
    }

    /**
     * Get all Pages
     * @return array
     */
    public function getAllPages()
    {
        return $this->entity->all();
    }

     /**
     * Get Active Pages
     * @return array
     */
    public function getActivePages()
    {
        return $this->entity->active();
    }

    /**
     * Select Page by ID
     * @param int $id
     * @return object
     */
    public function getPageById($id)
    {
        return $this->entity->find($id);
    }

     /**
     * Get Page by Permalink
     * @return array
     */
    public function getPageByPermalink($permalink)
    {
        return $this->entity->where("permalink", $permalink)->firstOrFail();
    }


    /**
     * Create a new Page
     * @param array $data
     * @return object
     */
    public function createPage(array $data)
    {
        return $this->entity->create($data);
    }

     /**
     * Update data of Page
     * @param object $page
     * @param array $data
     * @return object
     */
    public function updatePage(Page $page, array $data)
    {
        return $page->update($data);
    }

    /**
     * Delete a Page
     * @param object $page
     */
    public function destroyPage(Page $page)
    {
        return $page->delete();
    }
}
