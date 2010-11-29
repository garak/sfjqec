<?php

/**
 * Product filter form.
 *
 * @package    sfjqec
 * @subpackage filter
 * @author     Your name here
 */
class ProductFormFilter extends BaseProductFormFilter
{
  public function configure()
  {
    unset($this['slug']);
  }
}
