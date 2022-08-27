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

    public function generateNewName()
    {
        $this->name = time() . '-' . rand(100000, 999999) . '-' . uniqid();
    }

    public function getBasename()
    {
        //VALIDA EXTENSÃO
        $extension = strlen($this->extension) ? '.' . $this->extension : '';

        //VALIDA DUPLICAÇÃO
        $duplicates = $this->duplicates > 0 ? '-' . $this->duplicates : '';

        //RETORNA O NOME COMPLETO
        return $this->name . $duplicates . $extension;
    }

    /**
     * Método responsável por obter um nome possível para o arquivo
     * @param  string  $dir
     * @param  boolean $overwrite pode sobrescrever
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
     * Move o arquivo
     * @param  string  $dir
     * @param  boolean $overwrite
     * @return boolean
     */
    public function upload($dir, $overwrite = true)
    {
        if ($this->error != 0) return false;

        $basename = $this->getPossibleBasename($dir, $overwrite);
        $path = $dir . '/' . $basename;

        return ['result'=>move_uploaded_file($this->tmpName, $path),'basename'=>$basename];
    }
}
