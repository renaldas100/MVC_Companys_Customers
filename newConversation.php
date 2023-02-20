<?php

require_once "helper/DB.php";
require_once "models/Company.php";
require_once "models/Customer.php";
require_once "models/Conversation.php";

use Models\Conversation;


$customerId=$_GET['id'];

if (isset($_POST['save'])){
    $conversation=new Conversation($_POST['date'],$_POST['conversation'], $customerId);
    $conversation->save();
    header("location: index.php");
    die();
}



?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dokumentas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-12 my-5">
            <div class="card">
                <div class="card-header">Pokalbis</div>
                <div class="card-body">
                    <form method="post">
                        <div class="mb-3">
                            <label class="form-label">Data</label>
                            <input class="form-control" type="text" name="date" placeholder="PVZ.: 2023-02-17">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Pokalbis</label>
                            <input class="form-control" type="text" name="conversation">
                        </div>
                        <button type="submit" class="btn btn-success" name="save">Įrašyti</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>



