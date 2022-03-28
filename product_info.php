<?php

require __DIR__ . '/vendor/autoload.php';

use Automattic\WooCommerce\Client;

//api key setup 
$woocommerce = new Client(
    'http://sobetronic.com/Wordpress/', 
    'ck_98e2960b0a6f7e4d540ab71295910454eaf392e4', 
    'cs_118d816bb69e6e447e59a46700e97a45df1de329',
    [
        'version' => 'wc/v3',
    ]
);

$product_id = $_POST['product_id'];

$products = $woocommerce->get('products/'.$product_id);

$result = [];
$result['regular_price'] = $products->regular_price;
$result['stock_quantity'] = $products->stock_quantity;


echo json_encode($result);


?>