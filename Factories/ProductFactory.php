<?php

class ProductFactory
{
    public static function build($product_type, $sku, $name, $price)
    {

        $productClass = $product_type . "Product";

        return $productClassChecker = (class_exists($productClass)) ? (new $productClass($sku, $name, $price)) : json_encode(die("Invalid product type supplied"));

    }


}