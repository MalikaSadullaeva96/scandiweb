<?php
require_once 'connection.php';
abstract class Product 
{
  public $sku;
  public $name;
  public $price;

  public function __construct($sku, $name, $price) 
  {
      $this->sku = $sku;
      $this->name = $name;
      $this->price = $price;
  }

  public function InsertData() 
  {
      $extraAttributes = $this->getExtraColumns();
      $columnNames = join(", ", array_keys($extraAttributes));
      $columnValues =  join(", ", array_values($extraAttributes));
      $query = "INSERT INTO items (sku, name, price, $columnNames) VALUES ('$this->sku', '$this->name', $this->price, $columnValues)";

      $db = new Database();
      $conn = $db->conn;
      if ($conn->query($query) === TRUE) {
        echo "New record created successfully";
        header('Location: ../products.html');
    } else {
        echo "Error: " . $query . "<br>" . $conn->error;
    }
    $conn->close();
  }
  abstract public function getExtraColumns();
}
?>