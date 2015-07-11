<?php

use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;

class ProductTypesController extends ControllerBase
{
    public function initialize()
    {
        $this->tag->setTitle('Manage your products types');
        parent::initialize();
    }
    public function indexAction()
    {
        $this->session->conditions = null;
        $this->view->form = new ProductTypes();

    }
    public function searchAction()
    {
        $numberPage = 1;
        if($this->request->isPost())
        {
            $query = parent::fromInput($this->di,"ProductTypes",$this->request->getPost());
            $this->persistent->searchParams = $query->getParams();
        }
        else{
            $numberPage = $this->request->getQuery("page","int");
        }

        $parameters = array();
        if($this->persistent->searchParams)
        {
            $parameters=$this->persistent->searchParams;
        }
        $productTypes = ProductTypes::find($parameters);
        if(count($productTypes) == 0)
        {
            $this->flash->notice("No se han encontrado elementos que coincidan con la busqueda ingresada.");
            return $this->dispatcher->forward(array(
                'controller' => 'producttypes',
                'action' => 'index'
            ));        }
        $paginator = new Paginator(array("data"=>$productTypes,"limit"=>10,"page"=>$numberPage));
        $this->view->page = $paginator->getPaginate();
        $this->view->productTypes = $productTypes;
    }

}

