<?php

namespace Source\App;

class Web
{

    // public function __construct(){}
    public function product($data)
    {
        echo "<h1>312 </h1>";
        var_dump($data);
    }

    public function category($data)
    {
        echo "<h1>Category </h1>";
        var_dump($data);
    }

    public function error($data)
    {
        echo "<h1>Erro </h1>";
        var_dump($data);
    }
}
