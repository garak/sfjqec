<?php
use_helper('Number');
$arr = array();
foreach ($products as $product)
{
  $arr[] = array(
    'name'     => $product->getName(),
    'category' => $product->getCategory()->getName(),
    'price'    => format_currency($product->getPrice(), 'EUR'),
    'url'      => link_to('add to cart', 'cart_add', $product, 'class=add'),
  );
}

echo json_encode($arr);