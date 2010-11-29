<?php

/**
 * Product filter form.
 *
 * @package    sfjqec
 * @subpackage filter
 * @author     Your name here
 */
class ProductFrontedFormFilter extends ProductFormFilter
{
  public function configure()
  {
    parent::configure();
    unset($this['created_at'], $this['updated_at']);

    $this->widgetSchema['name'] = new sfWidgetFormInputText();
    $this->widgetSchema['price'] = new sfWidgetFormInputText();

    $this->validatorSchema['name'] = new sfValidatorString(array('required' => false));
    $this->validatorSchema['price'] = new sfValidatorNumber(array('required' => false));

    $this->disableLocalCSRFProtection();
  }
}
