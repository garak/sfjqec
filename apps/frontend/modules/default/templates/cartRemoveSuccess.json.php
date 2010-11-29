<?php
$arr = array(
  'total' => $sf_user->getCartTotal(),
);

echo json_encode($arr);