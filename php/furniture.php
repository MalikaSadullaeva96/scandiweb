<?php

require_once 'connection.php';

class Furniture extends Product {
    private $height;
    private $width;
    private $length;

    public function __construct($sku, $name, $price, $height, $width, $length) {
        parent::__construct($sku, $name, $price);
        $this->setHeight($height);
        $this->setWidth($width);
        $this->setLength($length);
    }

    public function getHeight() {
        return $this->height;
    }
    
    public function setHeight($height) {
        $this->height = $height;
    }
    
    public function getWidth() {
        return $this->width;
    }
    
    public function setWidth($width) {
        $this->width = $width;
    }
    
    public function getLength() {
        return $this->length;
    }
    
    public function setLength($length) {
        $this->length = $length;
    }

    public function insertData() {
        $db = new Database();

        $stmt = $db->conn->prepare("INSERT INTO items (sku, name, price, height, width, length) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssddii", $this->sku, $this->name, $this->price, $this->height, $this->width, $this->length);
        
        if ($stmt->execute()) {
            echo "New Furniture product inserted successfully";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
        $db->conn->close();
    }
}
?>