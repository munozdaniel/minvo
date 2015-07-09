<?php

class ProductsController extends ControllerBase
{
    public function initialize()
    {
        $this->tag->setTitle('Administrador de Productos');
        parent::initialize();
    }

    /**
     * La acción de inicio, permite buscar productos. En la primera pantalla veremos un formulario
     * para buscar los productos.
     */
    public function indexAction()
    {
        $this->persistent->searchParams = null;
        $this->view->productoForm = new ProductsForm();
    }
    /**
     * Realiza la búsqueda basada en los parámetros de usuario
     * devolviendo un paginador
     */
    public function buscarAction()
    {
        //...
    }
    /**
     * Muestra la vista de crear nuevos productos
     */
    public function nuevoAction()
    {
        //...
    }
    /**
     * Muestra la vista para editar productos existentes
     */
    public function editarAction()
    {
        //...
    }
    /**
     * Crea un nuevo producto basado en los datos ingresados en la acción "nuevo"
     */
    public function crearAction()
    {
        //...
    }
    /**
     * Actualiza un producto basado en los datos ingresados en la acción "editar"
     */
    public function guardarAction()
    {
        //...
    }

    /**
     * Elimina un producto existente
     */
    public function eliminarAction($id)
    {
        //...
    }

}

