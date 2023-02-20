<?php

namespace models;

use helper\DB;
use PDO;

class Conversation
{

    private ?int $id;
    private ?int $customer_id;
    private ?string $date;
    private ?string $conversation;

    /**
     * @param int|null $id
     * @param int|null $customer_id
     * @param string|null $date
     * @param string|null $conversation
     */
    public function __construct(?string $date, ?string $conversation, ?int $customer_id, ?int $id=null)
    {
        $this->id = $id;
        $this->customer_id = $customer_id;
        $this->date = $date;
        $this->conversation = $conversation;
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
     * @return int|null
     */
    public function getCustomerId(): ?int
    {
        return $this->customer_id;
    }

    /**
     * @param int|null $customer_id
     */
    public function setCustomerId(?int $customer_id): void
    {
        $this->customer_id = $customer_id;
    }

    /**
     * @return string|null
     */
    public function getDate(): ?string
    {
        return $this->date;
    }

    /**
     * @param string|null $date
     */
    public function setDate(?string $date): void
    {
        $this->date = $date;
    }

    /**
     * @return string|null
     */
    public function getConversation(): ?string
    {
        return $this->conversation;
    }

    /**
     * @param string|null $conversation
     */
    public function setConversation(?string $conversation): void
    {
        $this->conversation = $conversation;
    }


    public function save()
    {
        $pdo = DB::getDB();
        if ($this->id === null) {
            $stm = $pdo->prepare("INSERT INTO contact_information (date, conversation, customer_id) VALUES (?, ?, ?)");
            $stm->execute([$this->date, $this->conversation, $this->customer_id]);
            $this->id = $pdo->lastInsertId();
        } else {
            $stm = $pdo->prepare("UPDATE contact_information SET date=?, conversation=? WHERE id=?");
            $stm->execute([$this->date, $this->conversation, $this->id]);
        }
    }

    public function delete(){
        $pdo = DB::getDB();
        $stm=$pdo->prepare("DELETE FROM contact_information WHERE id=?");
        $stm->execute([$this->id]);

    }

    public static function get(int $id):Conversation{
        $pdo=DB::getDB();
        $stm=$pdo->prepare("SELECT * FROM contact_information WHERE id=?");
        $stm->execute([$id]);
        $conversation=$stm->fetch(PDO::FETCH_ASSOC);
        return new Conversation($conversation['date'],$conversation['conversation'], $conversation['customer_id'], $conversation['id']);
    }


    public static function getAllConversations():array{
        $pdo=DB::getDB();
        $stm=$pdo->prepare("SELECT * FROM contact_information ORDER BY date");
        $stm->execute([]);
        $result=[];
        foreach ($stm->fetchAll(PDO::FETCH_ASSOC) as $conversation){
            $result[]=new Conversation($conversation['date'],$conversation['conversation'], $conversation['customer_id'], $conversation['id']);
        }
        return $result;
    }

    /**
     * @param $customer_id
     * @return Conversation[]
     */
    public static function getConversationsByCustomerID($customer_id=null):array{
        $pdo=DB::getDB();
        if($customer_id==null) {
            $stm=$pdo->prepare("SELECT * FROM contact_information ORDER BY date");
            $stm->execute([]);
        }else {
            $stm = $pdo->prepare("SELECT * FROM contact_information  WHERE customer_id=? ORDER BY date");
            $stm->execute([$customer_id]);
        }
        $result=[];
        foreach ($stm->fetchAll(PDO::FETCH_ASSOC) as $conversation){
            $result[]=new Conversation($conversation['date'],$conversation['conversation'], $conversation['customer_id'], $conversation['id']);
        }
        return $result;
    }

    /** Gražina vartotojo pokalbių skaičių, reikia paduoti vartotojo ID
     * @param int $id
     * @return int
     */
    public static function countConversations($numb){

        return sizeof(self::getConversationsByCustomerID($numb));

    }



}
