<?php use_helper('Number') ?>
<div id="cart">
  <h2>Cart</h2>
  <?php if (count($cart) > 0): ?>
  <ul>
  <?php $i = 0 ?>
  <?php foreach ($cart as $pid => $q): ?>
    <li id="item_<?php echo $pid ?>">
      <?php echo $products->get($i) ?>
      <span class="price"><?php echo format_currency($products->get($i)->getPrice(), 'EUR') ?></span>
      <?php echo link_to('X', 'cart_remove', $products->get($i), 'class=remove') ?>
      <?php echo link_to('-', 'cart_decrease', $products->get($i), 'class=decrease') ?>
      <span class="quantity"><?php echo $q ?></span>
      <?php echo link_to('+', 'cart_increase', $products->get($i), 'class=increase') ?>
    </li>
  <?php $i ++ ?>
  <?php endforeach ?>
  </ul>
  <strong>Total:</strong> <span id="total"><?php echo format_currency($total, 'EUR') ?></span>
  <?php echo link_to('empty cart', '@cart_empty', 'id=empty_cart') ?>
  <?php endif ?>
</div>