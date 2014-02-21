<?

class Task_Model
{

    private static $_Loader = null;


    private static $_defaultOptions = array(
        'path' => null,
        'prefix' => ''
    );


    private static $_options = array();


    private static $modelInstances = array();


    public static function setOptions(array $options)
    {

        self::$_options = array_merge(self::$_defaultOptions, $options);

        if (empty(self::$_options['path'])) {
            throw new Exception('path option must be a string pointing to folder containing form scripts.');
        }
    }


    public static function get($model)
    {
        $model = ucfirst($model);

        if (empty(self::$modelInstances[$model])) {

            $class = self::loadForm($model);

            if ($class !== false) {

                $Form = new $class();
                self::$modelInstances[$model] = $Form;
            }
        }

        return self::$modelInstances[$model];
    }


    public static function loadForm($form)
    {

        return self::getLoader()->load($form);
    }


    public static function getLoader()
    {


        if (!self::$_Loader instanceof Zend_Loader_PluginLoader) {

            self::$_Loader = new Zend_Loader_PluginLoader(array(self::$_options['prefix'] => self::$_options['path']), 'Kakoona_Form');
        }
        return self::$_Loader;
    }


    public static function getPrefix()
    {

        return self::$_options['prefix'];
    }


    public static function getPath()
    {

        return self::$_options['path'];
    }
}