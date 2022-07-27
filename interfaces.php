<?php
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);

require_once __DIR__ . '/vendor/autoload.php';

interface FileUpload
{
    public function upload($file);

    public function remove($path);

    public function getUploadedFilePath(): string;
}

class LocalFileSystem implements FileUpload
{

    public function upload($file)
    {
        // TODO: Implement upload() method.
    }

    public function remove($path)
    {
        // TODO: Implement remove() method.
    }

    public function getUploadedFilePath(): string
    {
        return 'local path';
    }
}

class AwsFileSystem implements FileUpload
{
    public function upload($file)
    {
        // TODO: Implement upload() method.
    }

    public function remove($path)
    {
        // TODO: Implement remove() method.
    }

    public function getUploadedFilePath(): string
    {
        return 'aws path';
    }
}

class GoogleFileSystem implements FileUpload
{
    public function upload($file)
    {
        // TODO: Implement upload() method.
    }

    public function remove($path)
    {
        // TODO: Implement remove() method.
    }

    public function getUploadedFilePath(): string
    {
        return "Google path";
    }
}

function uploadFile(FileUpload $fileSystem, string $file)
{
    // ... .$file ....
    $fileSystem->upload($file);

    return $fileSystem->getUploadedFilePath();
}

$fileSystem = new LocalFileSystem();
echo uploadFile($fileSystem, "some_file");

$fileSystem = new AwsFileSystem();
echo uploadFile($fileSystem, "some_file");

$fileSystem = new GoogleFileSystem();
echo uploadFile($fileSystem, "some_file");
