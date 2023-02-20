<?php

use eftec\bladeone\BladeOne;
use models\Company;
use models\Customer;

require_once "vendor/autoload.php";


//$cvbcvb=new \Renaldas\Company()
//$sfdsdf=new Company();

//DB::getDB();
echo "vykdau užklausa";
//
//$jonas=new Company("Jono stalai","Jono gatvė 1","LT222222","Jono stalai","123456","jonas@jonas.lt");
//echo "<br>";
//var_dump($jonas->getId());
//print_r($jonas->getId());
echo "<br>";
//$jonas->save();
//echo "Company įrašas išsaugotas";
//echo "<br>";


//$vartotojas1=new Customer("Petras","Petrauskas","55555555","petras@petras.lt","Petro g.1","Vadybininkas");
//$vartotojas1->save();
//echo "Customer įrašas išsaugotas";
//echo "<br>";

//$pokalbis1=new Conversation("2023-02-14","Pastabos apie paslaugas");
//$pokalbis1->save();
//echo "Conversation įrašas išsaugotas";
//echo "<br>";


//$jonas->setName("Elenos stalai");
//$jonas->setCompanyName("Elenos stalai");
//$jonas->save();
//echo "Company įrašas atnaujintas";
//echo "<br>";

//$vartotojas1->setName("Bronius");
//$vartotojas1->setSurname("Bronauskas");
//$vartotojas1->save();
//echo "Customer įrašas atnaujintas";
//echo "<br>";
//
//$pokalbis1->setConversation("Aptarta prekių kokybė");
//$pokalbis1->save();
//echo "Conversation įrašas atnaujintas";
//echo "<br>";


//$jonas->delete(2);
//$jonas->save();

if (isset($_GET['delete'])) {
    Company::get($_GET['delete'])->delete();
    header("location: index.php");
    die();
}


//foreach (Customer::getCustomers() as $pirkejai) {
//    echo $pirkejai->getName();
//    echo $pirkejai->getSurname()."<br>";
//}


//$imone=Customer::getCompany(9);
//echo $imone-;

//$test=Customer::get(9);
//echo $test->getName();

//$test->setName("Antanas");
//$test->save();

//foreach (Company::all() as $imone){
//    echo $imone->getName();
//    echo $imone->getAddress()."<br>";
//}


// 1 VARIANTAS
echo "<hr> 1 VARIANTAS <br>";
$imone=Customer::get(9);
echo $imone->getCompany()->getName();

// 2 VARIANTAS
echo "<hr> 2 VARIANTAS <br>";
foreach (Customer::getCompany2(9) as $imone) {
    echo "Įmonė: ".$imone->getName() . "<br>";
}

// 3 VARIANTAS
echo "<hr> 3 VARIANTAS <br>";
$imone=Customer::getCompany3(9);
echo $imone;


echo "<hr> POKALBIO ISTORIJA: <br>";
foreach (Customer::getConversation(9) as $conversation) {
    echo $conversation['conversation'] . "<br>";
}

foreach (Company::all() as $imone) {
    echo "Įmonė: ".$imone->getName() . "<br>";
}

$vartotojai=Customer::countCustomers(5);
print_r($vartotojai);


$blade=new BladeOne(__DIR__."/views", __DIR__."/compile",BladeOne::MODE_DEBUG);
echo $blade->run("index");



