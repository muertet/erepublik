<?php
/* 1135

If project gets bigger we only need to set those functions to start caching

*/

if (!class_exists("Memcached")) {
class Memcached{
	
	public static function get($key){
		return false;
	}
	public static function set($id, $data, $timestamp = 0, $enc = true){
		return true;
	}
	public static function del($key){
		return true;
	}
}
}
?>