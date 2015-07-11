<?php
use \Phalcon\Forms\Element\Text;
use \Phalcon\Forms\Element\Hidden;
use \Phalcon\Forms\Element\Select;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Numericality;

class ProductsForm extends \Phalcon\Forms\Form
{
    /**
     * Inicializando el formulario del producto.
     */
    public function initialize($entidad=null, $opciones=array())
    {
        //Si entra la opcion editar, entonces se muestra el campo id, sino no.(en teoria)
        if (!isset($opciones['editar'])) {
            $elemento = new Text("id");
            $this->add($elemento->setLabel("ID"));
        } else {
            $this->add(new Hidden("id"));
        }
        //creo el campo nombre, tipo de producto y precio.
        $nombre = new Text("name");
        $tipoProducto = new Select("product_types_id", ProductTypes::find(),
            array(
                'using' => array('id', 'name'),
                'useEmpty' => true,
                'emptyText' => '...',
                'emptyValue' => ''
            ));
        $precio = new Text('price');

        //Seteando los labels.
        $nombre->setLabel('NOMBRE');
        $tipoProducto->setLabel('TIPO DE PRODUCTO');
        $precio->setLabel('PRECIO');


        //Agregando los filtros
        $nombre->setFilters(array('striptags', 'string'));
        $precio->setFilters(array('float'));


        //Validando los campos.
        $nombre->addValidators(
            array(
                new PresenceOf(
                    array('mensaje' =>  'El nombre es requerido.')
                )
            )
        );
        $precio->addValidators(
            array(
                new PresenceOf(array('mensaje'  =>  'El precio es requerido')),
                new Numericality(array('mensaje'    => 'NUmerality: El precio es requerido. '))
            )
        );
        //Agregando los campos al form
        $this->add($nombre);
        $this->add($tipoProducto);
        $this->add($precio);

    }
}