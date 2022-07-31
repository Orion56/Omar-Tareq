<?php

namespace App\Services;

class Media
{
    private array $file;
    private string $fileType = '';
    private string $fileExtension = '';
    private string $newFileName;
    private array $errors = [];


    /**
     * Set the value of file
     *
     * @return  self
     */
    public function setFile(array $file): self
    {
        $this->file = $file;
        $typeArray = explode('/', $this->file['type']); // ['image','png']
        $this->fileType = $typeArray[0]; // image
        $this->fileExtension = $typeArray[1]; // png
        return $this;
    }

    /**
     * Get the value of errors
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * Get the value of error
     */
    public function getError(string $key): ?string // size
    {
        if (isset($this->errors[$this->fileType][$key])) {
            return self::template($this->file[$this->fileType][$key]);
        }
        return null;
    }

    public function template(?string $value): string
    {
        return "<p class='text-danger font-weight-bold'>{$value}</p>";
    }

    /**
     * Get the value of newFileName
     */
    public function getNewFileName()
    {
        return $this->newFileName;
    }


    public function size(int $maxSize): self
    {
        if ($this->file['size'] > $maxSize) {
            $this->errors[$this->fileType][__FUNCTION__] = "Max Size Must Be Less Than {$maxSize} Bytes";
        }
        return $this;
    }

    public function extension(array $availableExentions): self
    {
        if (!in_array($this->fileExtension, $availableExentions)) {
            $this->errors[$this->fileType][__FUNCTION__] = "Avialable Exentsions Are " . implode(', ', $availableExentions);
        }
        return $this;
    }


    public function upload(string $pathTo): bool
    {
        $this->newFileName = uniqid('User_') . '.' . $this->fileExtension;
        $newFilePath = $pathTo . $this->newFileName;
        return move_uploaded_file($this->file['tmp_name'], $newFilePath);
    }


    public static function delete(string $path): bool
    {
        if (file_exists($path)) {
            unlink($path);
            return true;
        }
        return false;
    }
}
