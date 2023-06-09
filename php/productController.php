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

public static function deleteProducts($skus) 
{
    $skuList = explode(',', $_POST['skuList']);
    error_log("SKU List: " . print_r($skuList, true));

    $db = new Database();
    $conn = $db->conn;

    $placeholders = implode(',', array_fill(0, count($skuList), '?'));
    $query = $conn->prepare("DELETE FROM items WHERE sku IN ($placeholders)");
    if ($query === false) {
        error_log("Error preparing the query: " . implode(" ", $conn->errorInfo()));
        echo 'error: Error preparing the query';
        return;
    }
    
    $params = str_repeat("s", count($skuList));
    $query->bind_param($params, ...$skuList);
    
    $result = $query->execute();
    if ($result === false) {
        error_log("Error executing the query: " . $query->error);
        echo 'error: Error executing the query';
        return;
    }
    echo 'success';
}
  abstract public function getExtraColumns();
}

?>