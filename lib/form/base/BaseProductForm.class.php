<?php

/**
 * Product form base class.
 *
 * @method Product getObject() Returns the current form's model object
 *
 * @package    sfjqec
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseProductForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'name'        => new sfWidgetFormInputText(),
      'category_id' => new sfWidgetFormPropelChoice(array('model' => 'Category', 'add_empty' => false)),
      'price'       => new sfWidgetFormInputText(),
      'created_at'  => new sfWidgetFormDateTime(),
      'updated_at'  => new sfWidgetFormDateTime(),
      'slug'        => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorPropelChoice(array('model' => 'Product', 'column' => 'id', 'required' => false)),
      'name'        => new sfValidatorString(array('max_length' => 255)),
      'category_id' => new sfValidatorPropelChoice(array('model' => 'Category', 'column' => 'id')),
      'price'       => new sfValidatorNumber(),
      'created_at'  => new sfValidatorDateTime(array('required' => false)),
      'updated_at'  => new sfValidatorDateTime(array('required' => false)),
      'slug'        => new sfValidatorString(array('max_length' => 255, 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorPropelUnique(array('model' => 'Product', 'column' => array('slug')))
    );

    $this->widgetSchema->setNameFormat('product[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Product';
  }


}
