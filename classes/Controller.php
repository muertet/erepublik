<?php
class Controller {

    private $context;

    public function __construct ($context = false) {
        if (is_array($context)) {
            $this->context = new stdClass();
            foreach ($context as $k => $v) {
                $this->context->$k = $v;
            }
        }
    }
    /**
     * Starts a class method
     * @param string $cClass class name
     * @param string $method method name
     * @param array $args method arguments
     *
     * @return void
     */
    public static function start ($cClass, $method, $args) {
        $class = new $cClass();
        $class->$method($args);
    }

    /**
     * Parses multiple object views
     * @param $array object views array
     *
     * @return array
     */
    public function parseArray ($array)
    {
        $r = array();

        foreach ($array as $obj) {
            $r[] = $this->parse($obj);
        }
        return $r;
    }

    /**
     * Gets a param from current context
     * @param string $name params name
     * @param string $type params name
     * @param boolean $required params name
     *
     * @throws Exception if data is missing
     *
     * @return mixed
     */
    public function param ($name, $type = null, $required = false) {
        if (empty($this->context->$name)) {
            if ($required) {
                throw new Exception(ApiException::MISSING_DATA);
            } else {
                return null;
            }
        } elseif (empty($type)) {
            return $this->context->$name;
        } else {
            switch ($type) {
                case 'int':
                    $var = (int) $this->context->$name;

                    if ($required && $var < 1) {
                        throw new Exception(ApiException::MISSING_DATA);
                    } else {
                        return $var;
                    }
                    break;
                case 'str':
                case 'string':
                    $var = $this->context->$name;

                    if ($required && ( empty($var) || !is_string($var) )) {
                        throw new Exception(ApiException::MISSING_DATA);
                    } else {
                        return $var;
                    }
                    break;
            }
        }
    }
}