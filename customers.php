<?php

use eftec\bladeone\BladeOne;
use helper\Admin;
use models\Conversation;
use models\Customer;

require_once "config.php";

//require_once "vendor/autoload.php";
Admin::loginVerify();

echo "vykdau užklausa";
echo "<br>";

$id=$_GET['id'];
echo $id;

if (isset($_GET['delete'])) {
    Customer::get($_GET['delete'])->delete();
    header("location: index.php");
    die();
}

$blade=new BladeOne(__DIR__."/views", __DIR__."/compile",BladeOne::MODE_DEBUG);
echo $blade->run("customers",[
    "id"=>$id
]);