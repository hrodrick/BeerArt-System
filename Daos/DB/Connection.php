<?php
namespace Daos\DB;

class Connection {
    
    public function Connect(){

        return new \PDO("mysql:host=" . DB_HOST . "; dbname=" . DB_NAME, DB_USER, DB_PASS);
    }
}
?>