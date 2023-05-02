<?php
  require_once 'connection.php';

  class FetchProducts 
  {
    public function fetchAll() {
        $db = new Database();

        $stmt = $db->conn->prepare("SELECT * FROM items");
        $stmt->execute();

        $result = $stmt->get_result();
        $products = $result->fetch_all(MYSQLI_ASSOC);

        $stmt->close();
        $db->conn->close();

        return $products;
    }
  }
  $fetchProducts = new FetchProducts();
  $products = $fetchProducts->fetchAll();
  
  echo json_encode($products);
?>