<?php

/**
 * default actions.
 *
 * @package    sfjqec
 * @subpackage default
 * @author     Massimiliano Arione
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class defaultActions extends sfActions
{
  /**
   * index
   */
  public function executeIndex()
  {
    $filters = $this->getUser()->getFilters();
    $this->form = new ProductFrontedFormFilter();
    $this->form->bind($filters);
    $this->products = ProductQuery::create()->filter($filters);
  }

  /**
   * Filters
   * @param sfRequest $request
   */
  public function executeFilter(sfWebRequest $request)
  {
    $this->form = new ProductFrontedFormFilter();
    $this->form->bind($request->getParameter($this->form->getName()));
    if ($this->form->isValid())
    {
      $this->getUser()->setFilters($this->form->getValues());
      $this->redirectUnless($request->isXmlHttpRequest(), '@homepage');
      $this->products = ProductQuery::create()->filter($this->form->getValues());
    }
    else
    {
      $this->products = array();
      $this->setTemplate('index');
      if ($request->isXmlHttpRequest())
      {
        return $this->renderText('Error');
      }
    }
  }

  /**
   * Add product to cart
   * @param sfRequest $request
   */
  public function executeCartAdd(sfWebRequest $request)
  {
    $this->product = $this->getRoute()->getProduct();
    $this->getUser()->cartAdd($this->product);
    $this->redirectUnless($request->isXmlHttpRequest(), '@homepage');
  }

  /**
   * Remove product from cart
   * @param sfRequest $request
   */
  public function executeCartRemove(sfWebRequest $request)
  {
    $this->product = $this->getRoute()->getProduct();
    $this->getUser()->cartRemove($this->product);
    $this->redirectUnless($request->isXmlHttpRequest(), '@homepage');
  }

  /**
   * Increase quantity of product in cart
   * @param sfRequest $request
   */
  public function executeCartIncrease(sfWebRequest $request)
  {
    $this->product = $this->getRoute()->getProduct();
    $this->getUser()->cartIncrease($this->product);
    $this->redirectUnless($request->isXmlHttpRequest(), '@homepage');
  }

  /**
   * Decrease quantity of product in cart
   * @param sfRequest $request
   */
  public function executeCartDecrease(sfWebRequest $request)
  {
    $this->product = $this->getRoute()->getProduct();
    $this->getUser()->cartDecrease($this->product);
    $this->redirectUnless($request->isXmlHttpRequest(), '@homepage');
  }

  /**
   * Empty cart
   * @param sfRequest $request
   */
  public function executeCartEmpty(sfWebRequest $request)
  {
    $this->getUser()->cartEmpty();
    $this->redirectUnless($request->isXmlHttpRequest(), '@homepage');
  }

}
