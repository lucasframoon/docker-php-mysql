<?php

namespace Source\App;

use Leage\Plates\Engine;
// $route = new \CoffeeCode\Router\Router(URL_BASE);

class Web
{
    private $view;

    public function __construct(){
$templates = new Engine(__DIR__ . "/../../views");
        $templates->render('dashboard', ['name' => 'teste']);
    }

    public function home($data)
    {
        echo "<h1>  HOME </h1>";

    }

    public function error(array $data)
    {
        echo "<h1> Erro ". $data["errcode"] ."</h1>";
    }
}
