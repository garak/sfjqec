<?php

/**
 * Category frontend filter form.
 *
 * @package    sfjqec
 * @subpackage filter
 * @author     Massimiliano Arione
 */
class CategoryFrontendFormFilter extends CategoryFormFilter
{
  public function configure()
  {
    parent::configure();
    unset($this['created_at'], $this['updated_at']);
  }
}
