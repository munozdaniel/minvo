<?php
use Phalcon\Mvc\Dispatcher;
use Phalcon\Events\Event;
use Phalcon\Acl\Resource;
class Seguridad extends \Phalcon\Mvc\User\Plugin
{
    public function beforeExecuteRoute(Event $event, Dispatcher $dispatcher)
    {
        $auth = $this->session->get('auth');

        if(!$auth)
            $role = 'Guest';
        else
            $role = $auth["rol"];
        /*
        //esta sesión sólo la tendrá el admin
        $admin = $this->session->get('admin');
        //esta sesión sólo la tendrá el usuario registrado
        $registered = $this->session->get('registered');

        //si no es admin ni un usuario registrado es guest
        if (!$admin && !$registered)
        {
            $role = 'Guest';
        }
        //si es admin
        else if($admin)
        {
            $role = 'Admin';
        }
        //en otro caso es un usuario registrado
        else
        {
            $role = 'Registered';
        }
*/
        //nombre del controlador al que intentamos acceder
        $controller = $dispatcher->getControllerName();

        //nombre de la acción a la que intentamos acceder
        $action = $dispatcher->getActionName();

        //obtenemos la Lista de Control de Acceso(acl) que hemos creado
        $acl = $this->getAcl();

        //boolean(true | false) si tenemos permisos devuelve true en otro caso false
        $allowed = $acl->isAllowed($role, $controller, $action);

        //si el usuario no tiene acceso a la zona que intenta acceder
        //le mostramos el contenido de la función index del controlador index
        //con un mensaje flash
        if ($allowed != \Phalcon\Acl::ALLOW)
        {
            $this->flash->error("Zona restringida, no puedes entrar aquí!");
            $dispatcher->forward(
                array(
                    'controller' => 'index',
                    'action' => 'index'
                )
            );
            return false;
        }

    }

    /**
     * lógica para crear una aplicación con roles de usuarios
     */
    public function getAcl()
    {
        if (!isset($this->persistent->acl))
        {
            //creamos la instancia de acl para crear los roles
            $acl = new Phalcon\Acl\Adapter\Memory();

            //por defecto la acción será denegar el acceso a cualquier zona
            $acl->setDefaultAction(Phalcon\Acl::DENY);
            //----------------------------ROLES-----------------------------------

            //registramos los roles que deseamos tener en nuestra aplicación****
            $roles = array(
                'admin' 		=> new Phalcon\Acl\Role('Admin'),
                'registered' 	=> new Phalcon\Acl\Role('Registered'),
                'guest' 		=> new Phalcon\Acl\Role('Guest')
            );

            //añadimos los roles al acl
            foreach ($roles as $role)
            {
                $acl->addRole($role);
            }
            //---------------------------------------------------------------
            //----------------------------PAGINAS-----------------------------------
            //ZONAS accesibles sólo para rol admin ***
            $adminAreas = array(
                'admin' => array('index', 'save'),

            );

            //añadimos las zonas de administrador a los recursos de la aplicación
            foreach ($adminAreas as $resource => $actions)
            {//Añadimos controlador y la accion
                $acl->addResource(new Resource($resource), $actions);
            }
            //---------------------------------------------------------------
            //zonas protegidas sólo para usuarios registrados de la aplicación***
            $registeredAreas = array(
                'dashboard'     =>  array('index'),
                'profile'       =>  array('index', 'edit'),
                'products'      =>  array('index','buscar','editar','crear','eliminar'),
                'calendario'    =>  array('index'),
                'evento'        =>  array('index','guardar')

            );

            //añadimos las zonas para usuarios registrados a los recursos de la aplicación
            foreach ($registeredAreas as $resource => $actions)
            {
                $acl->addResource(new Resource($resource), $actions);
            }
            //---------------------------------------------------------------

            //zonas públicas de la aplicación
            $publicAreas = array(
                'index'     =>  array('index', 'register', 'login', 'end'),
                'sesion'  =>  array('index','validar','end','crear','eliminar')
            );

            //añadimos las zonas públicas a los recursos de la aplicación
            foreach ($publicAreas as $resource => $actions)
            {
                $acl->addResource(new Resource($resource), $actions);
            }
            //---------------------------------------------------------------
            //---------------------------ACCESOS------------------------------------

            //damos acceso a todos los usuarios a las zonas públicas de la aplicación
            foreach ($roles as $role)
            {
                foreach ($publicAreas as $resource => $actions)
                {
                    $acl->allow($role->getName(), $resource, '*');
                }
            }

            //damos acceso a la zona de admins solo a rol Admin
            foreach ($adminAreas as $resource => $actions)
            {
                foreach ($actions as $action)
                {
                    $acl->allow('Admin', $resource, $action);
                }
            }

            //damos acceso a las zonas de registro tanto a los usuarios
            //registrados como al admin
            foreach ($registeredAreas as $resource => $actions)
            {
                //damos acceso a los registrados
                foreach ($actions as $action)
                {
                    $acl->allow('Registered', $resource, $action);
                }
                //damos acceso al admin
                foreach ($actions as $action)
                {
                    $acl->allow('Admin', $resource, $action);
                }
            }

            //El acl queda almacenado en sesión
            $this->persistent->acl = $acl;
        }

        return $this->persistent->acl;
    }
    public function getAcl1()
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