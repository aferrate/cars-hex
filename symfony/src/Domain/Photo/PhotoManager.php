<?php

namespace App\Domain\Photo;

interface PhotoManager
{
    public function deleteOldPhoto(string $filename): bool;
    public function uploadArticleImage($uploadedFile, $oldImageFilename): string;
}