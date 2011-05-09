<?php use_helper('Number') ?>

<div id="filters">
  <h2>Filters</h2>
  <form method="post" action="<?php echo url_for('@filter') ?>">
    <table>
      <?php echo $form ?>
    </table>
    <input type="submit" value="filter" />
  </form>
</div>

<div id="products">
  <h2>Products</h2>
  <ul>
    <?php foreach ($products as $product): ?>
    <li>
      <?php echo $product ?>
      <span class="cat"><?php echo $product->getCategory() ?></span>
      <span class="price"><?php echo format_currency($product->getPrice(), 'EUR') ?></span>
      <?php echo link_to('add to cart', 'cart_add', $product, 'class=add') ?>
    </li>
    <?php endforeach ?>
    <?php if ($products->count() == 0): ?>
    <li class="no">No results</li>
    <?php endif ?>
  </ul>
</div>

<?php include_component('default', 'cart') ?>