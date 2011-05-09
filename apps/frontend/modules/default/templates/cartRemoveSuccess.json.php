<?php
use_helper('Number');
$arr = array(
  'total' => format_currency($sf_user->getCartTotal(), 'EUR'),
);

echo json_encode($arr);