<?php
class Logic{

    private $conn;
    private $db_table = "Product";

    public $id;
    public $sku;
    public $name;
    public $price;
    public $type;
    public $value;

    public function __construct($db){
        $this->conn = $db;
    }
    public function createProducts(){
        $sqlQuery = "INSERT INTO ". $this->db_table ."
                    SET
                        sku = :sku, 
                        name = :name, 
                        price = :price, 
                        type = :type, 
                        value = :value";

        $stmt = $this->conn->prepare($sqlQuery);

        $this->sku=htmlspecialchars(strip_tags($this->sku));
        $this->name=htmlspecialchars(strip_tags($this->name));
        $this->price=htmlspecialchars(strip_tags($this->price));
        $this->type=htmlspecialchars(strip_tags($this->type));
        $this->value=htmlspecialchars(strip_tags($this->value));

        $stmt->bindParam(":sku", $this->sku);
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":price", $this->price);
        $stmt->bindParam(":type", $this->type);
        $stmt->bindParam(":value", $this->value);
        if($stmt->execute()){
            return true;
        }
        return false;
    }

    public function getProducts(){
        $sqlQuery = "SELECT id, sku, name, price, type, value FROM " . $this->db_table . "";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute();
        return $stmt;
    }
    function deleteProducts(){
        $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE id = ?";
        $stmt = $this->conn->prepare($sqlQuery);
        $this->id=htmlspecialchars(strip_tags($this->id));
        $stmt->bindParam(1, $this->id);
        if($stmt->execute()){
            return true;
        }
        return false;
    }



}