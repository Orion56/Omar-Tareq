<?php

namespace App\Database\Models;

use App\Database\Config\Connection;

include "vendor/autoload.php";

class Model extends Connection
{
    const TABLE = '';
    public function all(array $columns = ['*'], array $filters = [])
    {
        $select = implode(', ', $columns);
        $query = "SELECT {$select} FROM " . static::TABLE; //here we must use static to refer to each object instance of the class 
        if (!empty($filters)) {
            $query .= " WHERE";
            foreach ($filters as $index => $filter) {
                if ($index != 0) {
                    $query .= " AND ";
                }
                $query .= " {$filter[0]} {$filter[1]} {$filter[2]}";
            }
        }
        return $this->con->query($query);
    }

    
    public function find(int $id)
    {
        $query = "SELECT * FROM " . static::TABLE . " WHERE id = ?";
        $stmt = $this->con->prepare($query);
        if (!$stmt) {
            return false;
        }
        $stmt->bind_param('i', $id);
        $stmt->execute();
        return $stmt->get_result();
    }
}
