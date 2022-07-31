<?php

namespace App\Database\Config;

class Connection
{
    private string $db_hostname = 'localhost';
    private int $db_port = 3306; //optional ->has default port
    private string $db_username = 'root';
    private string $db_password = '';
    private string $db_name = 'ecommerce_omar';
    public \mysqli $con;

    public function __construct()
    {
        $this->con = new \mysqli($this->db_hostname, $this->db_username, $this->db_password, $this->db_name, $this->db_port);
        if ($this->con->connect_error) {
            die("Error No:" . $this->con->connect_errno . "<br>Connection failed: " . $this->con->connect_error);
        }
        //echo "Connected..";
    }
    public function __destruct()
    {
        $this->con->close();
    }
}

new Connection;

