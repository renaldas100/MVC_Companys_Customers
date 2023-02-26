<?php

require_once "config.php";

use eftec\bladeone\BladeOne;
use helper\Admin;


if (isset($_POST['saveNewUser'])){
    if($_POST['password']===$_POST['password2']) {
        Admin::newUser($_POST['email'], $_POST['password']);
    }else{
        echo "SLAPTAŽODŽIAI NESUTAMPA - PASITIKRINK !!!!";
    }
}


$blade=new BladeOne(__DIR__."/views", __DIR__."/compile",BladeOne::MODE_DEBUG);
echo $blade->run("newUser");

