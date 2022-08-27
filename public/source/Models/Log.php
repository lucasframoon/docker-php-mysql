<?php

namespace Source\Models;

use CoffeeCode\DataLayer\DataLayer;

class Log extends DataLayer
{

    public function __construct()
    {
        parent::__construct("logs", ["ds_action"]);
    }
    
    public function saveAction($dsAction)
    {
        $this->ds_action = $dsAction;
        return $this->save();
    }
}
