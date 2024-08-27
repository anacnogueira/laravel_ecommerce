<?php

namespace App\Services;

use App\Repositories\Contracts\PageRepositoryInterface;

class PageService
{
    protected $pageRepository;

    public function __construct(PageRepositoryInterface $pageRepository)
    {
        $this->pageRepository = $pageRepository;
    }

    /**
     * Select all Pages
     * @return array
    */
    public function getAllPages()
    {
        return $this->pageRepository->getAllPages();
    }

     /**
     * Create a new Page
     * @param array $data
     * @return object 
    */
    public function makePage(array $data)
    {
        $page = $this->pageRepository->createPage($data);

        return $page;
    }

    /**
     * Get Page by  ID
     * @param int $id
     * @return object
    */
    public function getPageById(int $id)
    {
        return $this->pageRepository->getPageById($id);
    }

    /**
     * Update a Page
     * @param int $id
     * @param arrray $data
     * @return json response
    */
    public function updatePage(int $id, array $data)
    {
        $page = $this->pageRepository->getPageById($id);

        if (!$page) {
            return response()->json(['message' => 'Page Not Found'], 404);
        }

        $this->pageRepository->updatePage($page, $data);
        return response()->json(['message' => 'Page Updated'], 200);
    }

    /**
     * Delete a Page
     * @param int $id
     * @return json response
    */
    public function destroyPage(int $id)
    {
        $page = $this->pageRepository->getPageById($id);

        if (!$page) {
            return response()->json(['message' => 'Page Not Found'], 404);
        }

        $this->pageRepository->destroyPage($page);

        return response()->json(['message' => 'Page Deleted'], 200);
    }
}