<?php

namespace App\Services;

use App\Repositories\Contracts\PageRepositoryInterface;
use DOMDocument;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Services\DeleteFileService;

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
     * Select Active Pages
     * @return array
    */
    public function getActivePages()
    {
        return $this->pageRepository->getActivePages();
    }

     /**
     * Create a new Page
     * @param array $data
     * @return object
    */
    public function makePage(array $data)
    {
        $data["status"] = isset($data["status"]) ? 'S' : 'N';
        $data["show_in_menu"] = isset($data["show_in_menu"]) ? 1 : 0;

        $data["content"] = $this->uploadImagesFromContent($data["content"], $data["permalink"]);

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
     * Get Page by permalink
     * @param int $id
     * @return object
    */
    public function getPageByPermalink(string $permalink)
    {
        return $this->pageRepository->getPageByPermalink($permalink);
    }


    /**
     * Update a Page
     * @param int $id
     * @param arrray $data
     * @return json response
    */
    public function updatePage(int $id, array $data)
    {
        $data["status"] = isset($data["status"]) ? 'S' : 'N';
        $data["show_in_menu"] = isset($data["show_in_menu"]) ? 1 : 0;

        $page = $this->pageRepository->getPageById($id);

        if (!$page) {
            return response()->json(['message' => 'Page Not Found'], 404);
        }

        $data["content"] = $this->uploadImagesFromContent($data["content"], $data["permalink"]);

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

        //Delete images
        $dom= new DOMDocument();
        $dom->loadHTML($page->content,9);
        $images = $dom->getElementsByTagName('img');

        foreach ($images as $key => $img) {
            $filePath = str_replace('/storage/','',$img->getAttribute('src'));
            DeleteFileService::delete($filePath);
        }

        $this->pageRepository->destroyPage($page);

        return response()->json(['message' => 'Page Deleted'], 200);
    }

    private function uploadImagesFromContent($content, $permalink)
    {
        $dom = new \DOMDocument();
        libxml_use_internal_errors(true);
        $dom->loadHtml(mb_convert_encoding($content, 'HTML-ENTITIES', 'UTF-8'), LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

        $images = $dom->getElementsByTagName('img');

        foreach ($images as $key => $img) {
            $src = $img->getAttribute('src');

            if (preg_match('#data:image/(?<mime>.*?);base64,(?<data>.*)#', $src, $groups)) {
                $mimeType = $groups['mime'];
                $base64Data = $groups['data'];
                $imageData = base64_decode($base64Data);

                $extension = explode('/', $mimeType)[0];
                $fileName = $permalink . '-' . time(). "-".$key. '.' . $extension;
                $filePath = env('FILE_DESTINATION_PAGES').$fileName;

                Storage::disk('public')->put($filePath, $imageData);

                $newUrl = Storage::url($filePath);
                $img->removeAttribute('src');
                $img->setAttribute('src', $newUrl);
            }
        }

        return $dom->saveHTML();
    }
}
