<?

namespace Task;


class JsInit
{
    /**
     * @var mixed
     * @access private
     */
    private static $Instance;

    /**
     * methodStack
     * Stores method names as keys, data as their respective values
     * (default value: array())
     *
     * @var array
     * @access private
     */
    private $methodStack = array();

    /**
     * determines whether addMethod appends the methodStack or not
     *
     * (default value: false)
     *
     * @var bool
     * @access private
     */
    private $locked = false;

    /**
     * Determines whether to wrap enclosure method calls inside $(document).ready(function(){});
     * (default value: true)
     * @var mixed
     * @access private
     */
    private $useDocumentReady = true;

    /**
     * __set function.
     * @throws \Zend_Exception
     * @access public
     * @param mixed $name
     * @param mixed $value
     * @return void
     */
    public function __set($name, $value)
    {
        throw new \Zend_Exception('__set() is not allowed, please use addMethod() instead.');
    }

    /**
     * __get function.
     * @throws \Zend_Exception
     * @access public
     * @param mixed $name
     * @return void
     */
    public function __get($name)
    {
        throw new \Zend_Exception('__get() is not allowed.');
    }

    /**
     * Singleton pattern. getInstance() allows access to the only instance of this object from anywhere in the request lifecycle
     *
     * @access public
     * @static
     * @return object JsInit
     */
    public static function getInstance()
    {
        if (!self::$Instance instanceof JsInit) {
            self::$Instance = new JsInit;
        }

        return self::$Instance;
    }


    /**
     * addMethod function.
     * allows multiple arguments to be added, each of which get added to the Javascript method in the same order
     * @access public
     * @return JsInit
     */
    public function addMethod()
    {
        if (!$this->locked) {
            $args = func_get_args();
            $this->methodStack[] = array(
                'method' => array_shift($args),
                'args' => $args
            );
        }
        return $this;
    }


    public function removeMethod($method)
    {
        $i = 0;
        foreach ($this->_methodStack as $item) {
            if ($item['method'] == $method)
                unset($this->methodStack[$i]);
            $i++;
        }

        return $this;
    }

    /**
     * addTopMethod function.
     * proxy to addMethod, prepends window.top.window
     * @access public
     * @return JsInit
     */
    public function addTopMethod()
    {
        $args = func_get_args();
        $args[0] = 'window.top.window.' . $args[0];

        return call_user_func_array(array(
            $this,
            'addMethod'
        ), $args);
    }

    /**
     * lock function.
     *
     * @access public
     * @return JsInit
     */
    public function lock()
    {
        $this->locked = true;
        return $this;
    }

    /**
     * unlock function.
     *
     * @access public
     * @return JsInit
     */
    public function unlock()
    {
        $this->locked = false;
        return $this;
    }

    /**
     * clearMethods function.
     *
     * @access public
     * @return JsInit
     */
    public function clearMethods()
    {
        $this->methodStack = array();
        return $this;
    }

    /**
     * hasMethod function.
     *
     * @access public
     * @param mixed $method
     * @return boolean
     */
    public function hasMethod($method)
    {
        return array_key_exists($method, $this->_methodStack);
    }

    /**
     * setNoUseDocumentReady function.
     *
     * @access public
     * @return JsInit
     */
    public function setNoUseDocumentReady()
    {
        $this->useDocumentReady = false;
        return $this;
    }

    /**
     * setUseDocumentReady function.
     *
     * @access public
     * @return JsInit
     */
    public function setUseDocumentReady()
    {
        $this->useDocumentReady = true;
        return $this;
    }


    /**
     * converts method stack into client side Javascript enclosure
     *
     * @access public
     * @return string
     */
    public function __toString()
    {
        $enclosure = '';
        if (!empty($this->methodStack)) {
            $enclosure = '<script type="text/javascript">' . "\r\n";

            if ($this->useDocumentReady) {
                if (\Zend_Controller_Front::getInstance()->getRequest()->isXmlHttpRequest()) {
                    $enclosure .= '$(document).ready';
                } else {
                    $enclosure .= '$(window).load';
                }
            }

            $enclosure .= '(function(){' . "\r\n";

            foreach ($this->methodStack as $item) {
                $enclosure .= $item['method'] . '(';

                if (!empty($item['args'])) {
                    foreach ($item['args'] as $index => $arg) {
                        $enclosure .= ($index > 0 ? ',' : '') . \Zend_Json::encode($arg, true, array('enableJsonExprFinder' => true));
                    }
                }
                $enclosure .= ');' . "\r\n";
            }
            $enclosure .= '})';
            if (!$this->useDocumentReady)
                $enclosure .= '()';
            $enclosure .= '</script>';
        }

        return $enclosure;
    }
}