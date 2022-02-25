<?php

namespace App\model;

use PDO;

class Connect
{
    private $con;

    public function __construct()
    {
        $this->con = new PDO('mysql:host=' . HOST . ';port=3307;dbname=' . DBNAME . '', '' . ROOT . '', PASSWORD);
    }

    public function getCon()
    {
        return $this->con;
    }
}
