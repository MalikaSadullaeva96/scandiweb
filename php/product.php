<?php
abstract class Product {
  protected $sku;
  protected $name;
  protected $price;

  public function __construct($sku, $name, $price) {
    $this->setSku($sku);
    $this->setName($name);
    $this->setPrice($price);
  }

  public function getSku() {
    return $this->sku;
  }
  public function setSku($sku) {
    return $this->sku = $sku;
  }

  public function getName() {
    return $this->name;
  }

  public function setName($name) {
    $this->name = $name;
  }

  public function getPrice() {
    return $this->price;
  }

  public function setPrice($price) {
    $this->price = $price;
  }


  protected function isSkuUnique($sku) {
    $db = new Database();
    $stmt = $db->conn->prepare("SELECT COUNT(*) FROM items WHERE sku = ?");
    if (!$stmt) {
        echo "Error: Failed to prepare statement: " . $db->conn->error;
        return false;
    }
    $stmt->bind_param("s", $sku);
    $stmt->execute();
    $stmt->bind_result($count);
    $stmt->fetch();
    $stmt->close();
    $db->conn->close();

    return $count == 0;
}


  abstract public function insertData();
}
?>