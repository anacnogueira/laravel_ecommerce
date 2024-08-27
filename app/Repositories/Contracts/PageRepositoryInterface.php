<?php

namespace App\Repositories\Contracts;

use App\Models\Page;

interface PageRepositoryInterface
{
    public function getAllPages();
    public function getPageById($id);
    public function createPage(array $data);
    public function updatePage(Page $page, array $data);
    public function destroyPage(Page $page);
}