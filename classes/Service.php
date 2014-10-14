<?php
/**
 * This class creates instances of common services like cache or db
 *
*/
class Service
{
	private static $db;

	/**
	 * Gets db service
	 *
	 * @return object
	 */
	public static function getDB()
	{
		if (self::$db == null) {
			self::$db = new MysqliDb(Config::get('dbserver'), Config::get('dbuser'), Config::get('dbpass'), Config::get('dbname'), Config::get('dbport'));
		}
		return self::$db;
	}
}