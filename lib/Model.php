<?php

namespace MyApp;

class Model
{
    protected $db;

    public function __construct()
    {
        try {
            require '../vendor/autoload.php';
            $this->db = new \PDO('mysql:dbname=heroku_72675c89102211a;host=us-cdbr-iron-east-04.cleardb.net', 'b811cfd83b0539', 'xxx');
        } catch (\PDOException $e) {
            echo $e->getMessage();
            exit;
        }
    }
}
