<?php

use eftec\bladeone\BladeOne;
use models\Conversation;

require_once "vendor/autoload.php";




echo "vykdau užklausa";
echo "<br>";

$id=$_GET['id'];
echo $id;

if (isset($_GET['delete'])) {
    Conversation::get($_GET['delete'])->delete();
    header("location: index.php");
    die();
}

$blade=new BladeOne(__DIR__."/views", __DIR__."/compile",BladeOne::MODE_DEBUG);
echo $blade->run("conversations",[
    "id"=>$id
]);

