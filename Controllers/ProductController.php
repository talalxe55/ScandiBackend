<?php

class ProductController extends Model
{
    public $incomingRequest;
    public $response;

    public static function redirect($new_location): void
    {
        header("Location:" . $new_location);
        exit;
    }

    public static function outputResponse($response_message)
    {
        header("Content-Type: application/json");
        header("Accept': 'application/json");
        header("Accept': 'application/x-www-form-urlencoded");
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Headers: *");


        echo json_encode($response_message);

    }

    public static function list()
    {

        self::outputResponse((new ProductController)->fetchAll());
    }

    public static function create()
    {
        $incomingRequest = $_POST;

        $incomingProduct = ProductFactory::build(
            $incomingRequest['productType'],
            $incomingRequest['sku'],
            $incomingRequest['name'],
            $incomingRequest['price']
        );

        // if(!$incomingProduct->isUnique($incomingRequest['sku'])){
        //     self::outputResponse(["error_message" => 'SKU already exists!']);
        // }

        $incomingProduct->setValues([
            'size' => $incomingRequest['size'],
            'height' => $incomingRequest['height'],
            'width' => $incomingRequest['width'],
            'length' => $incomingRequest['length'],
            'weight' => $incomingRequest['weight']
        ]);

        self::outputResponse($incomingProduct->save());

    }

    public static function remove()
    {

        $incomingRequest = $_POST['product_ids'];

        self::outputResponse((new ProductController)->delete($incomingRequest));
    }

}