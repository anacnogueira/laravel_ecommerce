<?php

namespace App\Services;

use App\Repositories\Contracts\ProductPhotoRepositoryInterface;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Services\ImageProcessorService;
use App\Services\StoreFileService;
use App\Services\DeleteFileService;

class ProductPhotoService
{
    protected $productPhotoRepository;
    protected $imageService;

    public function __construct(
        ProductPhotoRepositoryInterface $productPhotoRepository,
        ImageProcessorService $imageService)
    {
        $this->productPhotoRepository = $productPhotoRepository;
        $this->imageService = $imageService;
    }

     /**
     * Create a new ProductPhoto
     * @param int $productId,
     * @param string $filename
     * @param string $extension
     * @param int $order
     * @return object
    */
    public function makeProductPhoto($productId, $file, $filename, $extension, $order)
    {

        //1. Imagem Grande
        $filenameBig = $filename.'.'.$extension;
        $imageBig = $this->createImage($file, $filenameBig, 'normal', null);

        //2. Thummbnail
        $filenameThumb = $filename.'-thumb.'.$extension;
        $imageThumb = $this->createImage($file, $filenameThumb, 'thumb', null);

        //Inserir  dados na tabela
        $data = [
            'product_id' => $productId,
            'photo_ori' => $imageBig['image'],
            'width_original' => $imageBig['width'],
            'height_original'=> $imageBig['height'],
            'photo_redim' => $imageThumb['image'],
            'width_redim' => $imageThumb['width'],
            'height_redim' => $imageThumb['height'],
            'order' => $order,
        ];

        $this->productPhotoRepository->createProductPhoto($data);
    }

     /**
     * Update a ProductPhoto
     * @param int $productId,
     * @param string $filename
     * @param string $extension
     * @param int $order
     * @param array $oldFiles
     * @return object
    */
    public function updateProductPhoto($productId, $file, $filename, $extension, $order, $oldFiles)
    {

        //1. Imagem Grande
        $filenameBig = $filename.'.'.$extension;
        $imageBig = $this->createImage($file, $filenameBig, 'normal', $oldFiles['photo_ori'] ?? null);

        //2. Thummbnail
        $filenameThumb = $filename.'-thumb.'.$extension;
        $imageThumb = $this->createImage($file, $filenameThumb, 'thumb', $oldFiles['photo_redim'] ?? null);

        //Exluir foto antiga da tabela
        $this->productPhotoRepository->deleteProductPhoto($productId, $order);

        //Inserir  novos dados na tabela
        $data = [
            'product_id' => $productId,
            'photo_ori' => $imageBig['image'],
            'width_original' => $imageBig['width'],
            'height_original'=> $imageBig['height'],
            'photo_redim' => $imageThumb['image'],
            'width_redim' => $imageThumb['width'],
            'height_redim' => $imageThumb['height'],
            'order' => $order,
        ];

        $this->productPhotoRepository->createProductPhoto($data);
    }

    public function deleteProductPhotosByProductId($productId)
    {

        $productPhotos = $this->productPhotoRepository->getPhotosByProductId($productId);

        foreach ($productPhotos as $productPhoto) {
            DeleteFileService::delete($productPhoto['photo_ori']);
            DeleteFileService::delete($productPhoto['photo_redim']);
            $this->productPhotoRepository->deleteProductPhoto($productId, $productPhoto['order']);
        }
    }

    private function createImage($file, $filename, $typeCompression, $oldFile = null)
    {
        if (!empty($oldFile)) {
            DeleteFileService::delete($oldFile);
        }

        switch ($typeCompression) {
        case 'normal':
            $rules = [
            'type'  => 'resize',
            'size'  => [500, 500], //width, height
            'quality' => 85,
            'output' => 'jpg'
            ];
            break;

        case 'thumb':
            $rules = [
            'type'  => 'resizemin',
            'size'  => [137, 137], //width, height
            'quality' => 70,
            'output' => 'jpg'
            ];
            break;
        }

        $processedFile = $this->imageService->process($file, $rules);

        if ($processedFile) {
            $destinationPath = env('FILE_DESTINATION_PRODUCTS');
            $binaryContent = $processedFile->toString();
            $filePath = $destinationPath . $filename;

            $imageStored = Storage::disk('public')->put($filePath, $binaryContent);

            return [
                'success' => true,
                'image' => $filePath,
                'width' => $this->imageService->width,
                'height'=> $this->imageService->height
            ];
        }

        return ['errors' => $this->imageService->errors ];
  }

}
