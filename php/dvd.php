<?php

require_once 'connection.php';

class DVD extends Product {
    private $size;

    public function __construct($sku, $name, $price, $size) {
        parent::__construct($sku, $name, $price);
        $this->setSize($size);
    }

    public function getSize() {
        return $this->size;
    }

    public function setSize($size) {
        $this->size = $size;
    }

    public function insertData() {
        $db = new Database();

        $stmt = $db->conn->prepare("INSERT INTO items (sku, name, price, size) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssds", $this->sku, $this->name, $this->price, $this->size);
        
        if ($stmt->execute()) {
            echo "New DVD product inserted successfully";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
        $db->conn->close();
    }
}
?>