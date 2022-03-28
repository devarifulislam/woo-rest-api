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

// post data ..
//var_dump($_POST);
$product_id = $_POST['product_id'];
$price = $_POST['product_price'];
$stock_quantity = (string)$_POST['product_stocks'];
$old_price = $_POST['old_product_price'];
$old_stock_quantity = (string)$_POST['old_product_stocks'];
$data = [
    'regular_price' => $price,
    'stock_quantity' => $stock_quantity,
    'manage_stock'=> true,
];


$products = $woocommerce->put('products/'.$product_id,$data);

//var_dump($products);
// $result = [];
// $result['regular_price'] = $products->regular_price;
// $result['stock_quantity'] = $products->stock_quantity;


if($products->regular_price == $old_price && $products->stock_quantity == $old_stock_quantity ){


    echo "noupdate";

}elseif($old_price != $products->regular_price && $old_stock_quantity != $products->stock_quantity  ){

    echo "updated";

}elseif($old_stock_quantity != $products->stock_quantity ){

    echo "stockupdate";

}elseif($old_price != $products->regular_price){

    echo "priceupdate";
}



// foreach($products as $product){

//     echo $product->id.' - '.$product->price.' - '.$product->stock_quantity.'</br>';
// }

// echo '<pre>';
// print_r($products->id);
// echo '</pre>';

?>