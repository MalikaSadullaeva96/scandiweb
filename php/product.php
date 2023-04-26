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

  abstract public function insertData();
}
?>