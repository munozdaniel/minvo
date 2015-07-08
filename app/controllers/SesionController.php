<?php

class SesionController extends \Phalcon\Mvc\Controller
{

    public function indexAction()
    {

    }

    /**
     * Encargado de la validacion de los datos introducidos en el formulario. Ademas
     * de validar los datos con la base de datos.
     */
    public function validarAction()
    {
        if($this->request->isPost())
        {
            //Obtengo los datos ingresado en el form.
            $email  = $this->request->getPost('email');
            $pass   = $this->request->getPost('password');
            //Busco el usuario en la bd a partir de los datos ingresados.
            $usuario = Users::findFirst(array(
                "(email = :email: OR username = :email:) AND (password = :password:) AND (active = 'Y')",
                'bind' => array('email' => $email, 'password' => sha1($pass))
            ));
            if($usuario!=false)
            {
                $this->_registerSession($usuario);
                $this->flash->success('Bienvenido'. $usuario->name);
                //return $this->forward('facturas/index');
                //Redireccionar la ejecución si el usuario es valido
                return $this->dispatcher->forward(array(
                    'controller' => 'index',
                    'action' => 'index'
                ));
            }
            else{
                $this->flash->error("Email/Contraseña Incorrecto");
            }
        }
        //return $this->forward('sesion/index');
        //Redireccionar la ejecución si el usuario es valido
        return $this->dispatcher->forward(array(
            'controller' => 'sesion',
            'action' => 'index'
        ));

    }
    public function _registerSession($usuario)
    {
        $this->session->set('auth',array('id'   =>  $usuario->id,
                                        'name'  =>  $usuario->name));
    }
    /**
     * Finishes the active session redirecting to the index
     *
     * @return unknown
     */
    public function endAction()
    {
        $this->session->remove('auth');
        $this->flash->success('Goodbye!');
        return $this->forward('index/index');
    }
}

