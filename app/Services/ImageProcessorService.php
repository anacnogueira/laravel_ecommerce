<?php

namespace App\Services;

use Intervention\Image\Laravel\Facades\Image;
use Intervention\Image\Interfaces\ImageInterface;
use Intervention\Image\Interfaces\EncodedImageInterface;
use Illuminate\Http\UploadedFile;
use Exception;

class ImageProcessorService
{
    public array $errors = [];
    public ?int $width = null;
    public ?int $height = null;

    public function process(UploadedFile $file, array $rules = [], array $allowed = []): ?EncodedImageInterface
    {
        $this->errors = [];
        $allowed = !empty($allowed) ? $allowed : ['jpg', 'jpeg', 'gif', 'png'];

        try {
            $extension = strtolower($file->getClientOriginalExtension());
            if (!in_array($extension, $allowed)) {
                $this->errors[] = "Extensão '{$extension}' não permitida.";
                return null;
            }

            $image = Image::read($file);

            $image = $this->applyTransformations($image, $rules);

            $this->width = $image->width();
            $this->height = $image->height();

            $format = $rules['output'] ?? $extension;
            $quality = $rules['quality'] ?? 90;

            return $this->encodeImage($image, $format, $quality);

        } catch (Exception $e) {
            $this->errors[] = "Erro ao processar imagem: " . $e->getMessage();
            return null;
        }
    }

    protected function applyTransformations(ImageInterface $image, array $rules): ImageInterface
    {
        $type = $rules['type'] ?? null;
        $size = $rules['size'] ?? null;

        if (!$type || !$size) return $image;

        $width = is_array($size) ? $size[0] : $size;
        $height = is_array($size) ? ($size[1] ?? $size[0]) : $size;

        return match ($type) {
            'resize'     => $image->resize($width, $height),
            'resizemin'  => $image->scale(width: $width, height: $height),
            'resizecrop' => $image->cover($width, $height),
            'crop'       => $image->crop($width, $height),
            default      => $image,
        };
    }

    protected function encodeImage(ImageInterface $image, string $format, int $quality): EncodedImageInterface
    {
        return match (strtolower($format)) {
            'png'         => $image->toPng(),
            'gif'         => $image->toGif(),
            'jpg', 'jpeg' => $image->toJpeg($quality),
            'webp'        => $image->toWebp($quality),
            default       => $image->toJpeg($quality),
        };
    }
}
