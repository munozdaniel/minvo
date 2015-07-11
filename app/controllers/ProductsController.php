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
        $this->view->formularioProducto = new ProductsForm(null,array('editar'=>true));
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
        //Si no es post, volver al inicio.
        if(!$this->request->isPost())
        {
            return $this->dispatcher->forward(array(
                'controller' => 'products',
                'action' => 'index'
            ));
        }
        // Si los datos ingresados no pasan el filtro de ProductsForm, volver al formulario nuevo.
        $formulario = new ProductsForm();
        $producto = new Products();
        $datos = $this->request->getPost();
        if(!$formulario->isValid($datos,$producto))
        {
            foreach ($formulario->getMessages() as $mensaje) {
                $this->flash->error($mensaje);
            }
            return $this->dispatcher->forward(array(
                'controller' => 'products',
                'action' => 'nuevo'
            ));
        }
        //Si hubo un problema al guardar los datos de producto, volverl al formulario nuevo.
        if($producto->save() == false)
        {
            foreach($producto->getMessages() as $mensaje)
            {
                $this->flash->error($mensaje);
            }
            return $this->dispatcher->forward(array(
                'controller' => 'products',
                'action' => 'nuevo'
            ));
        }
        $formulario->clear();
        $this->flash->success("Los datos se guardaron correctamente");
        return $this->dispatcher->forward(array(
            'controller' => 'products',
            'action' => 'index'
        ));

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

