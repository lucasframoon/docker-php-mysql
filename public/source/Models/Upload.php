<?php

namespace Source\Models;

class Upload
{

    private $name;
    private $extension;
    private $type;
    private $tmpName;
    private $error;
    private $size;
    private $duplicates = 0;

    public function __construct($file)
    {
        $this->type    = $file['type'];
        $this->tmpName = $file['tmp_name'];
        $this->error   = $file['error'];
        $this->size    = $file['size'];

        $info = pathinfo($file['name']);
        $this->name      = $info['filename'];
        $this->extension = $info['extension'];
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Generating a random name
     * @return string
     */
    public function generateNewName()
    {
        $this->name = time() . '-' . rand(100000, 999999) . '-' . uniqid();
    }

    /**
     * Getting the saved basename
     * @return string 
     */
    public function getBasename()
    {
        //Validating the extension
        $extension = strlen($this->extension) ? '.' . $this->extension : '';

        //Validating duplication
        $duplicates = $this->duplicates > 0 ? '-' . $this->duplicates : '';
        
        return $this->name . $duplicates . $extension;
    }

    /**
     * Getting a possible name for the file
     * @param  string  $dir -Directory where the file will be saved
     * @param  boolean $overwrite -Can overite?
     * @return string
     */
    private function getPossibleBasename($dir, $overwrite)
    {
        if ($overwrite) return $this->getBasename();

        $basename = $this->getBasename();

        if (!file_exists($dir . '/' . $basename)) {
            return $basename;
        }

        $this->duplicates++;

        return $this->getPossibleBasename($dir, $overwrite);
    }

    /**
     * Move the file
     * @param  string  $dir -Directory where the file will be saved
     * @param  boolean $overwrite -Can overite?
     * @return boolean
     */
    public function upload($dir, $overwrite = false)
    {
        if ($this->error != 0) return false;

        $basename = $this->getPossibleBasename($dir, $overwrite);
        $path = $dir . '/' . $basename;

        return ['result'=>move_uploaded_file($this->tmpName, $path),'basename'=>$basename];
    }
}
