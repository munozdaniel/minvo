<?php

use Phalcon\Mvc\Controller;

class ControllerBase extends Controller
{
    protected function initialize()
    {
        $this->tag->prependTitle("WEB - ");
    }
    public static function fromInput($dependencyInjector, $modelName, $data)
    {

        $conditions = array();
        if (count($data))
        {
            $metaData = $dependencyInjector->getShared('modelsMetadata');
            $model = new $modelName();
            $dataTypes = $metaData->getDataTypes($model);
            $columnMap = $metaData->getReverseColumnMap($model);
            $bind = array();

            foreach ($data as $fieldName => $value)
            {
                if (isset($columnMap[$fieldName]))
                {
                    $field = $columnMap[$fieldName];
                }
                else
                {
                    continue;
                }
                if(isset($dataTypes[$field]))
                {
                    if (!is_null($value))
                    {
                        if ($value != '')
                        {
                            /**
                             * si el campo es de tipo varchar o text aplicamos la clausula like
                             * int = 0
                             * timestamp = 1
                             * varchar = 2
                             * char = 5
                             * text = 6
                             */
                            //si es varchar text o timestamp utilizamos like
                            if ($dataTypes[$field] == 2 || $dataTypes[$field] == 6 || $dataTypes[$field] == 1)
                            {
                                $condition = $fieldName . " LIKE :" . $fieldName . ":";
                                $bind[$fieldName] = '%' . $value . '%';
                            }
                            //en otro caso buscamos la búsqueda exacta
                            else
                            {
                                $condition = $fieldName . ' = :' . $fieldName . ':';
                                $bind[$fieldName] = $value;
                            }
                            $conditions[] = $condition;
                        }
                    }
                }
            }
        }

        $criteria = new \Phalcon\Mvc\Model\Criteria();
        if (count($conditions))
        {
            $criteria->where(join(' AND ', $conditions));
            $criteria->bind($bind);
        }
        return $criteria;
    }
}
