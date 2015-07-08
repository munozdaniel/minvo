<?php
use Phalcon\Mvc\User\Component;

/**
 * Class ComponentesUsuario
 * Todos los elementos visuales en la aplicación han sido logrados usando mayormente con Twitter Bootstrap.
 * Algunos elementos, como la barra de navegación cambian de acuerdo al estado actual de la aplicación.
 * Por ejemplo, en la esquina superior derecha, el link “Log in / Sign Up” cambia a “Log out” si un usuario ha iniciado
 * sesión en la aplicación.
 * Esta parte de la aplicación es implementada en el componente de usuario “ComponentesUsuario” (app/library/ComponentesUsuario.php).
 */
class ComponentesUsuario extends Component
{
    /**
     * Atributos: array del menu secundario.    Estructura: _headerMenu[ nombreControlador[ nombreLabel,nombreAccion,nombreIcono ] ].
     */
    private $_headerMenu = array(
        'index' => array(
            'caption'   =>'Invitado',
            'accion'   => 'index',
            'icono' =>  'fa-user'
        )
        ,
        'perfil' => array(
            'caption'   =>'Perfil',
            'accion'   => '#',
            'icono' =>  'fa-user'
        )
        ,
        'correo'    =>  array(
            'caption'   =>'Correo',
            'accion'   =>  '#',
            'icono' =>  'fa-envelope'
        )
        ,
        'configuracion'    =>  array(
            'caption'   =>'Configuración',
            'accion'   =>  '#',
            'icono' =>  'fa-gear'
        )
        ,
        'sesion'    =>  array(
            'caption'   =>'Log In',
            'accion'   =>  '#',
            'icono' =>  'fa-sign-in'
        )
    );

    //****************************************
    /**
     * Construyendo el menu superio derecho
     */
    public function getMenu()
    {
        $auth = $this->session->get('auth');
        if ($auth) {
            $this->_headerMenu['navbar-right']['session'] = array(
                'caption' => 'Log Out',
                'action' => 'end'
            );
        } else {
            unset($this->_headerMenu['navbar-left']['invoices']);
        }

        $controllerName = $this->view->getControllerName();
        foreach ($this->_headerMenu as $position => $menu) {
            echo '<div class="nav-collapse">';
            echo '<ul class="nav navbar-nav ', $position, '">';
            foreach ($menu as $controller => $option) {
                if ($controllerName == $controller) {
                    echo '<li class="active">';
                } else {
                    echo '<li>';
                }
                echo $this->tag->linkTo($controller . '/' . $option['action'], $option['caption']);
                echo '</li>';
            }
            echo '</ul>';
            echo '</div>';
        }

    }

    public function getUsuario()
    {
       $auth = $this->session->get('auth');
        if ($auth) {
            $this->_headerMenu['index']['caption']    = $auth['name'];
            $this->_headerMenu['sesion']     =  array('icono'=>'fa-power-off','caption' => 'Log out',
                'accion' => 'end');
        }
        echo '<li class="dropdown">';
        echo    '<a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-user"></i>'. $this->_headerMenu['index']['caption'] .'<b class="caret"></b></a>';

        unset($this->_headerMenu['index']);

        echo '<ul class="dropdown-menu">';
        foreach ($this->_headerMenu as $pagina) {

                echo '<li><a href="#"><i class="fa fa-fw '.$pagina['icono'].'"></i> '.$pagina['caption'].'</a>';
                echo '</li>';

        }
        echo '</ul>';

    }

    public function getTabs()
    {

    }

}