<?php

namespace Task;

use Zend_Form;
use Zend_Registry;
use Zend_Exception;


Class Form extends Zend_Form
{
    public $formDecorators = array(
        'FormElements',
        array(
            'HtmlTag',
            array(
                'tag' => 'table',
                'class' => 'form-table'
            )
        )
    );

    public $elementDecorators = array(
        'ViewHelper',
        'Errors',
        array(
            array('data' => 'HtmlTag'),
            array(
                'tag' => 'div',
                'class' => 'element'
            )
        ),
        'Label',
        array(
            array('row' => 'HtmlTag'),
            array(
                'tag' => 'div',
                'class' => 'block_element'
            )
        ),
    );

    public $fileDecorator = array(
        'File',
        'Errors',
        array(
            array('data' => 'HtmlTag'),
            array(
                'tag' => 'div',
                'class' => 'element'
            )
        ),
        'Label',
        array(
            array('row' => 'HtmlTag'),
            array(
                'tag' => 'div',
                'class' => 'block_element'
            )
        )
    );

    public $submiDecorator = array(
        'ViewHelper',
        array(
            array('data' => 'HtmlTag'),
            array(
                'tag' => 'div',
                'class' => 'block_element submit'
            )
        ),
    );


    public function __construct($options = null)
    {
        \Task\JsInit::getInstance()->addMethod('Task.Form.initFormStyler');
        parent::__construct($options);

    }

    public function populateEntity($entity)
    {
        return parent::populate($this->convertEntityToArray($entity));
    }

    /**
     * @return \Pimple
     */
    public function getServiceManager()
    {
        return \Zend_Registry::get('servicemanager');
    }


    /**
     * @param $service
     * @return mixed
     * @throws \Zend_Exception
     */
    public function getService($service)
    {
        if (!$this->getServiceManager()->offsetExists($service)) {
            throw new Zend_Exception("Сервис $service отсутствует");
        }

        return $this->getServiceManager()->offsetGet($service);
    }


    /**
     * @return \Doctrine\Orm\EntityManager
     */
    public function getEntityManager()
    {
        return $this->getService('em');
    }


    protected function convertEntityToArray($entity)
    {
        $data = array();
        $metadata = Zend_Registry::get('servicemanager')->offsetGet('em')->getClassMetadata(get_class($entity));

        foreach ($metadata->fieldMappings as $field => $mapping) {
            $value = $metadata->reflFields[$field]->getValue($entity);
            if ($value instanceof \DateTime) {
                $data[$field] = $value->format('Y-m-d');
            } elseif (is_object($value)) {
                $data[$field] = (string)$value;
            } else {
                $data[$field] = $value;
            }
        }

        return $data;
    }
}