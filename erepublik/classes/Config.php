<?php

class Config
{
    private static $instance = null;


    public static function get($k)
    {
        if (self::$instance == null)
            self::$instance = new Config();

        return self::$instance->$k;
    }

    private function __construct()
    {
		require_once (dirname(dirname(__FILE__)).'/conf/config.php');

		if(!isset($this->currentEnv)){
			foreach ($envs as $env=>$urls)
	        {
	            if (preg_match ("/$urls/", $_SERVER['HTTP_HOST']))
	            {
	                $this->currentEnv = $env;
	                break;
	            }
	        }	
		}

        foreach ($config as $k=>$v)
        {
            if ($this->isEnvDependent ($v, $envs))
                $this->$k = $v[$this->currentEnv];
            else
                $this->$k = $v;
        }
    }

    private function isEnvDependent ($value, $envs)
    {
        if (!is_array($value)) return false;

        foreach (array_keys($envs) as $envName)
            if (!in_array($envName, array_keys($value)))
                return false;

        return true;
    }

    public static function getBaseUrl ()
    {
        return 'http://'.$_SERVER['HTTP_HOST'].self::get('basedir');
    }
}