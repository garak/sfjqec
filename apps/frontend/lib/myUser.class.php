<?php

class myUser extends sfBasicSecurityUser
{
  /**
   * @param array $filters
   */
  public function setFilters(array $filters)
  {
    $this->setAttribute('filters', $filters);
  }

  /**
   * @return array
   */
  public function getFilters()
  {
    return $this->getAttribute('filters', array());
  }

  /**
   * @return array
   */
  public function getCart()
  {
    return $this->getAttribute('cart', array());
  }

  /**
   * @return float
   */
  public function getCartTotal(PropelCollection $products = null)
  {
    $cart = $this->getAttribute('cart', array());
    if (is_null($products))
    {
      $products = ProductQuery::create()->findPks(array_keys($cart));
    }
    $total = 0.00;
    $i = 0;
    foreach ($cart as $pid => $q)
    {
      $total += $products->get($i)->getPrice() * $q;
      $i ++;
    }

    return $total;
  }

  /**
   * @param Product $product
   */
  public function cartAdd(Product $product)
  {
    $cart = $this->getAttribute('cart', array());
    $cart[$product->getId()] = empty($cart[$product->getId()]) ? 1 : $cart[$product->getId()];
    $this->setAttribute('cart', $cart);
  }

  /**
   * @param Product $product
   */
  public function cartRemove(Product $product)
  {
    $cart = $this->getAttribute('cart', array());
    if (isset($cart[$product->getId()]))
    {
      unset($cart[$product->getId()]);
    }
    $this->setAttribute('cart', $cart);
  }

  /**
   * @param Product $product
   */
  public function cartIncrease(Product $product)
  {
    $cart = $this->getAttribute('cart', array());
    $cart[$product->getId()] = empty($cart[$product->getId()]) ? 1 : $cart[$product->getId()] + 1;
    $this->setAttribute('cart', $cart);
  }

  /**
   * @param Product $product
   */
  public function cartDecrease(Product $product)
  {
    $cart = $this->getAttribute('cart', array());
    $cart[$product->getId()] = empty($cart[$product->getId()]) ? 0 : $cart[$product->getId()] - 1;
    if ($cart[$product->getId()] == 0)
    {
      unset($cart[$product->getId()]);
    }
    $this->setAttribute('cart', $cart);
  }

  /**
   */
  public function cartEmpty()
  {
    $this->setAttribute('cart', array());
  }

}
