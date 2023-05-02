<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'productController.php';
require_once 'book.php';
require_once 'dvd.php';
require_once 'furniture.php';

function insertData(Product $product)
{
    $product->InsertData();
}

if (isset($_POST['delete']) && isset($_POST['skuList'])) {
  Product::deleteProducts($_POST['skuList']);
}

if (isset($_POST['submit'])) 
{

    $sku = $_POST['sku'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $productType = $_POST['productType'];

    switch ($productType) {
        case 'DVD':
            $size = $_POST['size'];
            $dvd = new DVD($sku, $name, $price, $size);
            insertData($dvd);
            break;
        case 'Book':
            $weight = $_POST['weight'];
            $book = new Book($sku, $name, $price, $weight);
            insertData($book);
            break;
        case 'Furniture':
            $width = $_POST['width'];
            $length = $_POST['length'];
            $height = $_POST['height'];
            $furniture = new Furniture($sku, $name, $price, $width, $length, $height);
            insertData($furniture);
            break;
        default:
            echo "Invalid product type";
            break;
    }
}
?>