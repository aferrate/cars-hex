<?php
/**
 * Created by PhpStorm.
 * User: anon
 * Date: 28/05/2019
 * Time: 0:11
 */

namespace App\Infrastructure\Service;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Filesystem\Filesystem;
use App\Domain\Photo\PhotoManager;

class UploaderHelper implements PhotoManager
{
    private $uploadsPath;

    public function __construct(string $uploadsPath)
    {
        $this->uploadsPath = $uploadsPath;
    }

    public function uploadArticleImage($uploadedFile, $oldImageFilename): string
    {
        $this->deleteOldPhoto((is_null($oldImageFilename) ? '' : $oldImageFilename));

        $destination = $this->uploadsPath;
        $newFilename = uniqid() . '.' . $uploadedFile->guessExtension();

        $uploadedFile->move(
            $destination,
            $newFilename
        );

        return $newFilename;
    }

    public function deleteOldPhoto(string $fileName): bool
    {
        if($fileName == '') {
            return false;
        }

        $filesystem = new Filesystem();
        $filesystem->remove($this->uploadsPath.$fileName);

        return true;
    }
}