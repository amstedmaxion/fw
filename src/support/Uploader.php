<?php

namespace src\support;

use DateTime;
use Exception;

class Uploader
{
    private object $file;
    private string $path;
    private string $name;

    /**
     * @param string $completePath - Additional path in the application upload directory
     * @return void
     */
    public function __construct(string $path)
    {
        $this->path = $path;
    }


    public function file(object $file)
    {
        $this->file = $file;
        return $this;
    }

    function unlink(string $path)
    {
        unlink($path);
    }


    public function upload()
    {
        $this->name = md5(uniqid()) . (new DateTime("now"))->getTimestamp();

        if (!$this->validated())
            throw new Exception("O arquivo ({$this->file->name}) não foi carregado, pois sua extensão não é permitida", 404);

        if (!$this->validateUploadDirectory())
            $this->createUploadDirectory();


        $uploaded = move_uploaded_file($this->file->tmp_name, $this->path . $this->name);

        if ($uploaded)
            return $this->name;
    }


    private function validated()
    {
        $exts = ["pdf", "doc", "docx", "xlsx", "xls"];
        $ext = strtolower(pathinfo($this->file->name, PATHINFO_EXTENSION));
        $this->name .= '.' . $ext;
        return in_array($ext, $exts);
    }

    /**
     * Checks if the informed path is a directory
     * @return bool
     */
    function validateUploadDirectory(): bool
    {
        return is_dir($this->path);
    }

    /**
     * Responsible for creating a directory
     * @return void
     */
    function createUploadDirectory(): void
    {
        mkdir($this->path, 0777, true);
        exec('chmod 777 ' . $this->path);
    }


    function getFilesInArray()
    {
        $files = $_FILES["answer_attachments"];
        $total = count(array_filter($_FILES["answer_attachments"]["name"]));
        $toReturn = [];
        for ($index = 0; $index < $total; $index++) {
            $toReturn[] = (object) [
                "name" => $files["name"][$index],
                "type" => $files["type"][$index],
                "tmp_name" => $files["tmp_name"][$index],
                "error" => $files["error"][$index],
                "size" => $files["size"][$index]
            ];
        }

        return $toReturn;
    }
}
