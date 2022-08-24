<?php

namespace Source\App;

use Source\Models\Product;

class Web
{

    public function error($data)
    {
        echo "<h1> Erro " . $data['errcode'] . "</h1>";
    }
}
