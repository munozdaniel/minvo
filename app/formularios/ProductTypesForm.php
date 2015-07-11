<?php
use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Email;

class ProductTypesForm extends Form
{
    /**
     *
     */
    public function initialize($entity = null, $options = array())
    {
        if(isset($options['edit'])){
            $element = new Text("id");
            $this->add($element->setLabel("Id"));
        }
        else
            $this->add(new Hidden("id"));

        $name = new Text("name");
        $name->setLabel("Name");
        $name->setFilters(array('striptags','strings'));
        $name->addValidators(array(new PresenceOf(array('message'=> "Name is required"))));
        $this->add($name);
    }
}