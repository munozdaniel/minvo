<?php
use Phalcon\Mvc\Dispatcher;
use Phalcon\Events\Event;
class Seguridad extends \Phalcon\Mvc\User\Plugin
{
    public function beforeExecuteRoute(Event $event, Dispatcher $dispatcher)
    {
        //Verificar si la variable de sesión 'auth' está definida, esto indica si hay un usuario autenticado
        $auth = $this->session->get('auth');
        if(!$auth)
            $rol = 'Invitado';
        else
            $rol = 'Usuario';

        //Obtener el controlador y acción actual desde el Dispatcher
        $controlador = $dispatcher->getControllerName();
        $accion = $dispatcher->getActionName();

        //Obtener la lista ACL
        $acl = $this->getAcl();

        //Verificar si el pérfil (rol) tiene acceso al controlador/acción
        $permitido = $acl->isAllowed($rol, $controlador,$accion);
        if($permitido != \Phalcon\Acl::ALLOW)
        {
            //Si no tiene acceso mostramos un mensaje y lo redireccionamos al inicio
            $this->flash->error("No tiene acceso a este modulo.");
            $dispatcher->forward(array('controller'=>'errores','action'=>'mostrar401'));
        }
        //Devolver "false" le indica al Dispatcher que debe detener la operación
        //y evitar que la acción se ejecute
        return false;

    }
    public function getAcl()
    {
        //Crear el ACL
        $acl = new Phalcon\Acl\Adapter\Memory();
        //La accion por defecto es denegar
        $acl->setDefaultAction(\Phalcon\Acl::DENY);
        //Registrar dos roles, 'users' son usuarios registrados
        //y 'guests' son los usuarios sin un pérfil definido (invitados)
        $roles = array(
            'users' => new Phalcon\Acl\Role('Usuario'),
            'guests' => new Phalcon\Acl\Role('Invitado')
        );
        foreach ($roles as $role) {
            $acl->addRole($role);
        }

        /**
         * Ahora definiremos los recursos para cada área respectívamente.
         * Los nombres de controladores son recursos y sus acciones son accesos a los recursos:
         */
        //Recursos del área privada (backend)
        $recursosPrivados = array(
            'companies' => array('index','search','new','edit','save','create','delete'),
            'products' => array('index', 'search', 'new', 'edit', 'save', 'create', 'delete'),
            'producttypes' => array('index', 'search', 'new', 'edit', 'save', 'create', 'delete'),
            'invoices' => array('index', 'profile')
        );
        foreach($recursosPrivados as $recurso => $accion)
        {
            $acl->addResource(new \Phalcon\Acl\Resource($recurso),$accion);
        }
        //Recursos del área pública (frontend)
        $recursosPublicos = array('index'=>array('index'),
            'about'=>array('index'),
            'sesion'=>array('index','register','validar','start','end'),
            'contact'=>array('index','send'));
        foreach($recursosPublicos as $recurso => $accion)
        {
            $acl->addResource(new \Phalcon\Acl\Resource($recurso),$accion);
        }
        /**
         * El ACL ahora tiene conocimiento de los controladores existentes y sus acciones.
         * El perfil “Users” tiene acceso tanto al backend y al frontend. El perfil “Guests” solo tiene acceso al área pública.
         */
        //Permitir acceso al área pública tanto a usuarios como a invitados
        foreach($roles as $rol)
        {
            foreach($recursosPublicos as $recurso => $acciones)
            {
                $acl->allow($rol->getName(),$recurso,'*');
            }
        }
        foreach($recursosPrivados as $recurso => $acciones)
        {
            foreach($acciones as $accion)
            {
                $acl->allow('Usuarios',$recurso,$accion);
            }
        }
    }
}