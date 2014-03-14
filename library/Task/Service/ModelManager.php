<?php

namespace Task\Service;


class ModelManager
{
    const name_space = 'Models';
    private $models;


    public function getModel($key)
    {
        $key = ucfirst($key);

        if(!isset($this->models[$key])){

            if(!class_exists(self::name_space. '\\' . $key)){
                throw new \Zend_Exception("Модель $key не была найдена");
            }
            $className = self::name_space. '\\' . $key;
            $this->models[$key] = new $className;
        }

        return $this->models[$key];
    }
}