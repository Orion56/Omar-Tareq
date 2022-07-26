<?php

namespace App\Database\Config;

include "vendor/autoload.php";

class Model extends Connection
{
    const TABLE = '';
    public static function all()
    {
        $query = "SELECT * FROM " . static::TABLE; //here we must use static to refer to each object instance of the class 
    }
    public static function find(int $id)
    {
        $query = "SELECT * FROM " . static::TABLE . " WHERE id = {$id}";
    }
}
