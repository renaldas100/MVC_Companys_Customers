<?php

namespace helper;

use PDO;

class DB
{

    public static ?PDO $pdo=null;

    private function __construct()
    {

    }

    public static function getDB(){
        if(self::$pdo==null){
            self::$pdo = new PDO('mysql:host=localhost;dbname=crm_customers', 'root',);
//            echo "PRISIJUNGIU <br>";
        }

        return self::$pdo;
    }

}
