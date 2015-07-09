<?php
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;
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
        $numeroDePagina =1;
        if($this->request->isPost())
        {   //Cuando se accese a traves del post.
            //Creando las condiciones de la query. Criteria te permite buscar por diferentes criterios, y devuelve una query
            //de aquellos datos qeu se ingresaron, ignorando los vacios.
            $query = Criteria::fromInput($this->di,"Products",$this->request->getPost());
            $this->persistent->searchParams = $query->getParams();

        }
        else
        {
            //Cuando se accede a traves del GET se mueve entre las paginas del paginador.
            $numberPage = $this->request->getQuery("page", "int");
        }
        $parametros = array();
        if($this->persistent->searchParams)
        {
            $parametros = $this->persistent->searchParams;
        }

        $productos = Products::find($parametros);
        if(count($productos)==0)
        {
            $this->flash->notice("No se encontraron Productos.");
            return $this->dispatcher->forward(array(
                'controller' => 'products',
                'action' => 'index'
            ));
        }
        /*Paginando el resultado que se encuentra en la variable productos.*/
        $paginador = new Paginator(
            array(
                "data"  =>  $productos,
                "limit" =>  10,
                "page"  =>  $numeroDePagina
            )
        );
        $this->view->page = $paginador->getPaginate();
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

