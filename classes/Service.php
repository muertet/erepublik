<?php

class Service
{
	public static function get($class, array $args = null) {
        return new $class($args);
    }
}