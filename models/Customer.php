<?php


namespace models;

use helper\DB;
use PDO;


class Customer
{
   private ?int $id;
   private ?string $name;
   private ?string $surname;
   private ?string $phone;
   private ?string $email;
   private ?string $address;
   private ?string $position;
   private ?int $company_id;




    /**
     * @param int|null $id
     * @param string|null $name
     * @param string|null $surname
     * @param string|null $phone
     * @param string|null $email
     * @param string|null $address
     * @param string|null $position
     * @param int|null $company_id
     */
    public function __construct(?string $name, ?string $surname, ?string $phone, ?string $email, ?string $address, ?string $position, ?int $company_id, ?int $id=null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->surname = $surname;
        $this->phone = $phone;
        $this->email = $email;
        $this->address = $address;
        $this->position = $position;
        $this->company_id = $company_id;
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
    public function getSurname(): ?string
    {
        return $this->surname;
    }

    /**
     * @param string|null $surname
     */
    public function setSurname(?string $surname): void
    {
        $this->surname = $surname;
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
    public function getPosition(): ?string
    {
        return $this->position;
    }

    /**
     * @param string|null $position
     */
    public function setPosition(?string $position): void
    {
        $this->position = $position;
    }

    /**
     * @return int|null
     */
    public function getCompanyId(): ?int
    {
        return $this->company_id;
    }

    /**
     * @param int|null $company_id
     */
    public function setCompanyId(?int $company_id): void
    {
        $this->company_id = $company_id;
    }



    public function save()
    {
        $pdo = DB::getDB();
        if ($this->id === null) {
            $stm = $pdo->prepare("INSERT INTO customers (name, surname, phone, email, address, position, company_id) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stm->execute([$this->name, $this->surname, $this->phone, $this->email, $this->address, $this->position, $this->company_id]);
            $this->id = $pdo->lastInsertId();
        } else {
            $stm = $pdo->prepare("UPDATE customers SET name=?, surname=?, phone=?, email=?, address=?, position=? WHERE id=?");
            $stm->execute([$this->name, $this->surname, $this->phone, $this->email, $this->address, $this->position, $this->id]);
        }
    }

    public function delete(){
        $pdo = DB::getDB();
        $stm=$pdo->prepare("DELETE FROM customers WHERE id=?");
        $stm->execute([$this->id]);

    }

    public static function get(int $id):Customer{
        $pdo=DB::getDB();
        $stm=$pdo->prepare("SELECT * FROM customers WHERE id=?");
        $stm->execute([$id]);
        $customer=$stm->fetch(PDO::FETCH_ASSOC);
        return new Customer($customer['name'],$customer['surname'], $customer['phone'], $customer['email'], $customer['address'], $customer['position'], $customer['company_id'], $customer['id']);
    }

    /** Gražina visus vartotojus, jei nerašom ID-visus, jei įrašom, tai tik tą, ką įrašėm
     * @return Customer[]
     */
    public static function getCustomers($id=null):array{
        $pdo=DB::getDB();
        if($id==null) {
            $stm = $pdo->prepare("SELECT * FROM customers ORDER BY name");
            $stm->execute([]);
        }else {
            $stm = $pdo->prepare("SELECT * FROM customers  WHERE id=? ORDER BY name");
            $stm->execute([$id]);
        }
        $result=[];
        foreach ($stm->fetchAll(PDO::FETCH_ASSOC) as $customer){
            $result[]=new Customer($customer['name'],$customer['surname'], $customer['phone'], $customer['email'], $customer['address'], $customer['position'], $customer['company_id'], $customer['id']);
        }
        return $result;
    }


    /** Gražina visus vartotojus pagal įmonės ID, jei nerašom ID-visus, jei įrašom, tai tik tuos, kuriems atitinka priskirtos įmonės ID
     * @return Customer[]
     */
    public static function getCustomersByCompanyID($company_id=null):array{
        $pdo=DB::getDB();
        if($company_id==null) {
            $stm = $pdo->prepare("SELECT * FROM customers ORDER BY name");
            $stm->execute([]);
        }else {
            $stm = $pdo->prepare("SELECT * FROM customers  WHERE company_id=? ORDER BY name");
            $stm->execute([$company_id]);
        }
        $result=[];
        foreach ($stm->fetchAll(PDO::FETCH_ASSOC) as $customer){
            $result[]=new Customer($customer['name'],$customer['surname'], $customer['phone'], $customer['email'], $customer['address'], $customer['position'], $customer['company_id'], $customer['id']);
        }
        return $result;
    }



    /** 1 variantas. Gražina kliento įmonę
     * @param int $id
     * @return mixed
     */
    public function getCompany(){
        $imonesID = $this->company_id;
        return Company::get($imonesID);
    }

    /** 2 variantas. Gražina kliento įmonę, reikia įvesti kliento id, atvaizdavimui reikia kito foreach
     * @param int $id
     * @return Company[]
     */
    public static function getCompany2(int $id){
        $pdo=DB::getDB();
        $stm=$pdo->prepare("SELECT * FROM customers WHERE id=?");
        $stm->execute([$id]);
        $customer=$stm->fetch(PDO::FETCH_ASSOC);
        return Company::all($customer['company_id']);

    }

    /** 3 variantas. Gražina kliento įmonę, reikia įvesti kliento id
     * @param int $id
     * @return mixed
     */
    public static function getCompany3(int $id){
         $pdo=DB::getDB();
        $stm=$pdo->prepare("SELECT co.name FROM companys co LEFT JOIN customers cu ON co.id=cu.company_id WHERE cu.id=?");
        $stm->execute([$id]);
        $company=$stm->fetch(PDO::FETCH_ASSOC);
        return $company['name'];
    }




    /** Gražina pokalbių istoriją, masyvą, reikia įvesti vartotojo ID, atvaizdavimui reikia kito foreach
     * @return array
     */
    public static function getConversation(int $id):array{
        $pdo=DB::getDB();
        $stm=$pdo->prepare("SELECT co.conversation FROM contact_information co LEFT JOIN customers cu ON co.customer_id=cu.id WHERE cu.id=?");
        $stm->execute([$id]);
        $conversations=$stm->fetchAll(PDO::FETCH_ASSOC);

        return $conversations;
    }

    /** Gražina vartotojų skaičių įmonėje, reikia paduoti įmonės ID
     * @return int
     */
    public static function countCustomers(int $id){
        $count=0;
        foreach (self::getCustomers() as $customer){
            if($customer->getCompanyId()==$id) {
                $count++;
            }
        }
        return $count;

    }



}

