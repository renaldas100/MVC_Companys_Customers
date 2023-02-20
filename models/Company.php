<?php

namespace models;

use helper\DB;
use PDO;


class Company
{
    private ?int $id;
    private ?string $name;
    private ?string $address;
    private ?string $vat_code;
    private ?string $company_name;
    private ?string $phone;
    private ?string $email;

    /**
     * @param int|null $id
     * @param string|null $name
     * @param string|null $address
     * @param string|null $vat_code
     * @param string|null $company_name
     * @param string|null $phone
     * @param string|null $email
     */
    public function __construct(?string $name, ?string $address, ?string $vat_code, ?string $company_name, ?string $phone, ?string $email, ?int $id=null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->address = $address;
        $this->vat_code = $vat_code;
        $this->company_name = $company_name;
        $this->phone = $phone;
        $this->email = $email;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     */
    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     */
    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string|null
     */
    public function getAddress(): ?string
    {
        return $this->address;
    }

    /**
     * @param string|null $address
     */
    public function setAddress(?string $address): void
    {
        $this->address = $address;
    }

    /**
     * @return string|null
     */
    public function getVatCode(): ?string
    {
        return $this->vat_code;
    }

    /**
     * @param string|null $vat_code
     */
    public function setVatCode(?string $vat_code): void
    {
        $this->vat_code = $vat_code;
    }

    /**
     * @return string|null
     */
    public function getCompanyName(): ?string
    {
        return $this->company_name;
    }

    /**
     * @param string|null $company_name
     */
    public function setCompanyName(?string $company_name): void
    {
        $this->company_name = $company_name;
    }

    /**
     * @return string|null
     */
    public function getPhone(): ?string
    {
        return $this->phone;
    }

    /**
     * @param string|null $phone
     */
    public function setPhone(?string $phone): void
    {
        $this->phone = $phone;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string|null $email
     */
    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }



    public function save()
    {
        $pdo = DB::getDB();
        if ($this->id === null) {
//            echo " irasom ";
//            var_dump($pdo);
            $stm = $pdo->prepare("INSERT INTO companys (name, address, vat_code, company_name, phone, email) VALUES (?, ?, ?, ?, ?, ?)");
//            echo " irasom 2 ";
            $stm->execute([$this->name, $this->address, $this->vat_code, $this->company_name, $this->phone, $this->email]);
            $this->id = $pdo->lastInsertId();
        } else {
            $stm = $pdo->prepare("UPDATE companys SET name=?, address=?, vat_code=?, company_name=?, phone=?, email=? WHERE id=?");
            $stm->execute([$this->name, $this->address, $this->vat_code, $this->company_name, $this->phone, $this->email, $this->id]);
        }
    }

    public function delete(){
        $pdo = DB::getDB();
        $stm=$pdo->prepare("DELETE FROM companys WHERE id=?");
        $stm->execute([$this->id]);

    }

    public static function get(int $id):Company{
        $pdo=DB::getDB();
        $stm=$pdo->prepare("SELECT * FROM companys WHERE id=?");
        $stm->execute([$id]);
        $company=$stm->fetch(PDO::FETCH_ASSOC);
        return new Company($company['name'],$company['address'], $company['vat_code'], $company['company_name'], $company['phone'], $company['email'], $company['id']);
    }


//    public static function getAllCompanys():array{
//        $pdo=DB::getDB();
//        $stm=$pdo->prepare("SELECT * FROM companys ORDER BY name");
//        $stm->execute([]);
//        $result=[];
//        foreach ($stm->fetchAll(PDO::FETCH_ASSOC) as $company){
//            $result[]=new Company($company['name'],$company['address'], $company['vat_code'], $company['company_name'], $company['phone'], $company['email'], $company['id']);
//        }
//        return $result;
//    }

    /** Gražina visas įmones, jei nerašom ID-visas, jei įrašom, tai tik tą, ką įrašėm
     * @param $id
     * @return Company[]
     */
    public static function all($id=null):array{
        $pdo=DB::getDB();
        if($id==null){
            $stm=$pdo->prepare("SELECT * FROM companys ORDER BY name");
            $stm->execute([]);
        }else{
            $stm=$pdo->prepare("SELECT * FROM companys WHERE id=? ORDER BY name");
            $stm->execute([$id]);
        }
        
        $result=[];
        foreach ($stm->fetchAll(PDO::FETCH_ASSOC) as $company){
            $result[]=new Company($company['name'],$company['address'], $company['vat_code'], $company['company_name'], $company['phone'], $company['email'], $company['id']);
        }
        return $result;
    }





}