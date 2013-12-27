<?php
/**
* False cache class used in some methods to get project ready for cache
*/
class Cache
{
	public static function get($key)
	{
		return false;
	}
	
	public static function set($key,$content,$time)
	{
		return true;
	}
}