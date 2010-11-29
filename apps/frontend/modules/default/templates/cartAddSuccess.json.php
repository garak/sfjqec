<?php
use_helper('Number');
$arr = array(
  'name'       => $product->getName(),
  'price'      => format_currency($product->getPrice(), 'EUR'),
  'quantity'   => 1,
  'total'      => format_currency($sf_user->getCartTotal(), 'EUR'),
  'a_remove'   => link_to('X', 'cart_remove', $product, 'class=remove'),
  'a_increase' => link_to('+', 'cart_increase', $product, 'class=increase'),
  'a_decrease' => link_to('-', 'cart_decrease', $product, 'class=decrease'),
  'a_empty'    => link_to('empty cart', '@cart_empty', 'id=empty_cart'),
);

echo json_encode($arr);