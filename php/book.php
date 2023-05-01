<?php

require_once 'connection.php';

// class Book extends Product {
//     private $weight;

//     public function __construct($sku, $name, $price, $weight) {
//         parent::__construct($sku, $name, $price);
//         $this->setWeight($weight);
//     }

//     public function getWeight() {
//         return $this->weight;
//     }
    
//     public function setWeight($weight) {
//         $this->weight = $weight;
//     }

//     public function insertData() {
        
//         $db = new Database();

//         if (!$this->isSkuUnique($this->sku)) {
//             echo "Error: A product with SKU '$this->sku' already exists.";
//             return;
//         }

//         $stmt = $db->conn->prepare("INSERT INTO items (sku, name, price, weight) VALUES (?, ?, ?, ?)");
//         $stmt->bind_param("ssdd", $this->sku, $this->name, $this->price, $this->weight);
        
//         if ($stmt->execute()) {
//             // echo "New Book product inserted successfully";
//             header('Location: ../products.html');
//             exit;
//         } else {
//             echo "Error: " . $stmt->error;
//         }

//         $stmt->close();
//         $db->conn->close();
//     }
// }

class Book extends Product {
    public $weight;

    public function __construct($sku, $name, $price, $weight) {
        parent:: __construct($sku, $name, $price);
        $this->weight = $weight;
    }

    public function GetExtraColumns() {
        return ["weight" => $this->weight];
    }

}

?>