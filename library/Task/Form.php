<?php

namespace Task;

use Zend_Form;
use Zend_Registry;


Class Form extends Zend_Form
{
    public function populateEntity($entity)
    {
        return parent::populate($this->convertEntityToArray($entity));
    }

    protected function convertEntityToArray($entity)
    {
        $data = array();
        $metadata = Zend_Registry::get('servicemanager')->raw('em')->getClassMetadata(get_class($entity));

        foreach ($metadata->fieldMappings as $field => $mapping)
        {
            $value = $metadata->reflFields[$field]->getValue($entity);
            if ($value instanceof \DateTime)
            {
                $data[$field] = $value->format('Y-m-d');
            }
            elseif (is_object($value))
            {
                $data[$field] = (string)$value;
            }
            else
            {
                $data[$field] = $value;
            }
        }

        return $data;
    }
}