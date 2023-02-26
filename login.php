<?php

//echo password_hash("admin",PASSWORD_DEFAULT);

use eftec\bladeone\BladeOne;
use helper\Admin;
use helper\DB;
use models\Company;

require_once "config.php";

if(isset($_POST['login'])){
   if (Admin::login($_POST['email'],$_POST['password'])!=null){
       header('location: index.php');
       die();
   }else{
       echo "Blogi prisijungimai";
   }
}

if (isset($_GET['logout'])){
    Admin::logout();
}



$blade=new BladeOne(__DIR__."/views", __DIR__."/compile",BladeOne::MODE_DEBUG);
echo $blade->run("login");

