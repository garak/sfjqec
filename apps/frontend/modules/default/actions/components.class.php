<?php

/**
 * default Components.
 *
 * @package    sfjqec
 * @subpackage default
 * @author     Massimiliano Arione
 */
class defaultComponents extends sfComponents
{
  public function executeCart()
  {
    $this->cart = $this->getUser()->getCart();
    $this->products = ProductQuery::create()->findPks(array_keys($this->cart));
    $this->total = $this->getUser()->getCartTotal($this->products);
  }
}