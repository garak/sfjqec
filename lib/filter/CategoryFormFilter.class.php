<?php

/**
 * Category filter form.
 *
 * @package    sfjqec
 * @subpackage filter
 * @author     Your name here
 */
class CategoryFormFilter extends BaseCategoryFormFilter
{
  public function configure()
  {
    unset($this['slug']);
  }
}
