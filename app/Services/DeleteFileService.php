<?php
namespace App\Services;

use Illuminate\Support\Facades\Storage;

class DeleteFileService
{
    public static function delete($filePath)
    {
        $fileExists = Storage::disk('public')->exists($filePath);
        if ($fileExists) {
            Storage::disk('public')->delete($filePath);
        }
    }

}
