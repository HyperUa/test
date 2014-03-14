<?php

namespace Task\Service;

use Zend_Exception;

/**
 * Class ConfigManager
 * @package Task
 */
class ConfigManager
{
    const defName = 'main';
    const defType  = 'ini';

    private $configMain;
    private $configsList;
    private $manageConfig;

    /**
     * @param array $config
     */
    public function __construct(array $config)
    {
        //TODO: разные типы конфигов
        $this->configMain = $config;

        $configsPath = $this->getParamsFromMainConfig('manager.config');
        // $configType  = $this->getParamsFromMainConfig('manager.type', self::defType);

        $this->manageConfig = new \Zend_Config_Ini($configsPath);
    }

    /**
     * @param string $key
     * @param null $section
     * @param bool $options
     * @return \Zend_Config
     * @throws \Zend_Exception
     */
    public function getConfig($key = self::defName, $section = null, $options = false)
    {
        if($key == self::defName){
            return $this->configMain;
        }

        if(!isset($this->configsList[$key])){

            $configs = $this->getParamsFromConfig($this->manageConfig, self::defType);
            if(!$configs || !array_key_exists($key, $configs)){
                throw new \Zend_Exception('Конфиг не найден');
            }

            $config = new \Zend_Config_Ini($configs[$key].'.'.self::defType, $section, $options);
            if(!$config instanceof \Zend_Config){
                throw new \Zend_Exception('Конфиг не найден');
            }
            $this->configsList[$key] = $config;
        }

        return $this->configsList[$key];
    }

    /**
     * @param null $option
     * @param null $default
     * @return array|null|string
     */
    public function getParamsFromMainConfig($option = null, $default = null)
    {
        return $this->getParamsFromConfig(array(), $option, $default);
    }

    /**
     * @param array $config
     * @param null $option
     * @param null $default
     * @return array|string|null
     */
    public function getParamsFromConfig($config = array(), $option = null, $default = null)
    {
        if($config == array()){
            $config = $this->configMain;
        }
        if($config instanceof \Zend_Config){
            $config = $config->toArray();
        }

        if($option == null){
            return $config;
        }

        $options = explode('.', $option);

        foreach($options as $option){
            if(!isset($config[$option]))
                return $default;

            $config = $config[$option];
        }

        return $config;
    }
}