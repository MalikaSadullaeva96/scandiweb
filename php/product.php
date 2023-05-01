<?php
// abstract class Product {
//   protected $sku;
//   protected $name;
//   protected $price;

//   public function __construct($sku, $name, $price) {
//     $this->setSku($sku);
//     $this->setName($name);
//     $this->setPrice($price);
//   }

//   public function getSku() {
//     return $this->sku;
//   }
//   public function setSku($sku) {
//     return $this->sku = $sku;
//   }

//   public function getName() {
//     return $this->name;
//   }

//   public function setName($name) {
//     $this->name = $name;
//   }

//   public function getPrice() {
//     return $this->price;
//   }

//   public function setPrice($price) {
//     $this->price = $price;
//   }


//   protected function isSkuUnique($sku) {
//     $db = new Database();
//     $stmt = $db->conn->prepare("SELECT COUNT(*) FROM items WHERE sku = ?");
//     if (!$stmt) {
//         echo "Error: Failed to prepare statement: " . $db->conn->error;
//         return false;
//     }
//     $stmt->bind_param("s", $sku);
//     $stmt->execute();
//     $stmt->bind_result($count);
//     $stmt->fetch();
//     $stmt->close();
//     $db->conn->close();

//     return $count == 0;
// }

//   abstract public function insertData();
// }

abstract class Product {
  public $sku;
  public $name;
  public $price;

  public function __construct($sku, $name, $price) {
      $this->sku = $sku;
      $this->name = $name;
      $this->price = $price;
  }

  public function InsertData() {
      $extraAttributes = $this->GetExtraColumns();
      $columnNames = join(", ", array_keys($extraAttributes));
      $columnValues =  join(", ", array_values($extraAttributes));
      $query = "INSERT INTO items (sku, name, price, $columnNames) VALUES ('$this->sku', '$this->name', $this->price, $columnValues)";

      $db = new Database();
      $conn = $db->conn;
      if ($conn->query($query) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $query . "<br>" . $conn->error;
    }
    $conn->close();
  }
  abstract public function GetExtraColumns();
}
?>