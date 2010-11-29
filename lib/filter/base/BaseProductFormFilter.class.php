<?php

/**
 * Product filter form base class.
 *
 * @package    sfjqec
 * @subpackage filter
 * @author     Your name here
 */
abstract class BaseProductFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'name'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'category_id' => new sfWidgetFormPropelChoice(array('model' => 'Category', 'add_empty' => true)),
      'price'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'created_at'  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'updated_at'  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'slug'        => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'name'        => new sfValidatorPass(array('required' => false)),
      'category_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Category', 'column' => 'id')),
      'price'       => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'created_at'  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'updated_at'  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'slug'        => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('product_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Product';
  }

  public function getFields()
  {
    return array(
      'id'          => 'Number',
      'name'        => 'Text',
      'category_id' => 'ForeignKey',
      'price'       => 'Number',
      'created_at'  => 'Date',
      'updated_at'  => 'Date',
      'slug'        => 'Text',
    );
  }
}
