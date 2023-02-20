<?php

require_once "helper/DB.php";
require_once "models/Company.php";
require_once "models/Customer.php";
require_once "models/Conversation.php";

use Models\Customer;

$companyId=$_GET['id'];

if (isset($_POST['save'])){
    $customer=new Customer($_POST['name'],$_POST['surname'],$_POST['phone'],$_POST['email'],$_POST['address'],$_POST['position'],$companyId);
//    print_r($customer);
    $customer->save();
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
                <div class="card-header">Vartotojai</div>
                <div class="card-body">
                    <form method="post">
                        <div class="mb-3">
                            <label class="form-label">Vardas</label>
                            <input class="form-control" type="text" name="name">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Pavardė</label>
                            <input class="form-control" type="text" name="surname">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Telefonas</label>
                            <input class="form-control" type="text" name="phone">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">El.paštas</label>
                            <input class="form-control" type="text" name="email">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Adresas</label>
                            <input class="form-control" type="text" name="address">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Pareigos</label>
                            <input class="form-control" type="text" name="position">
                        </div>
                        <button type="submit" class="btn btn-success" name="save">Pridėti</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>
