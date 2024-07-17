<?php
namespace App\Services;


class StoreFileService
{
    protected $uploadedFile;
    protected $basePath;
    protected $fileName;
    
    public function __construct($file, $basePath, $fileName)
    {
        $this->uploadedFile = $file;
        $this->basePath = $basePath;
        $this->fileName = $fileName;
    }

    public function upload()
    {
        $path = $this->storeImage();

        return $path;
    }

    private function storeImage()
    {
        return $this->uploadedFile->storeAs(
            $this->basePath,
            $this->generateUniqueFileName()
        );
    }  

    private function generateUniqueFileName()
    {
        return $this->fileName . '.' . $this->uploadedFile->getClientOriginalExtension();
    }

}