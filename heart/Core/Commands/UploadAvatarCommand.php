<?php namespace Qdiscuss\Core\Commands;

use RuntimeException;
use Qdiscuss\Core\Support\FileUpload;

class UploadAvatarCommand
{
    public $userId;

    /**
     * @var \Symfony\Component\HttpFoundation\File\UploadedFile
     */
    public $file;

    public $actor;

    public function __construct($userId, $file, $actor)
    {
        if (empty($userId) || !intval($userId)) {
            throw new RuntimeException('No valid user ID specified.');
        }

        if (is_null($file)) {
            throw new RuntimeException('No file to upload');
        }

        $this->userId = $userId;
        $this->file = new FileUpload($file);
        $this->actor = $actor;
    }
}
