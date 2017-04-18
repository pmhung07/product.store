<?php

namespace Nht\Hocs\Core;

/**
 * Class description.
 *
 * @author	Andrea Marco Sartori
 */
class MongoDb
{

	private static $instance = null;

	private function __construct()
	{
		// Configuration
		$dbhost = '127.0.0.1';
		$dbname = 'nht-test';

		// Connect to test database
		$m = new \MongoClient("mongodb://$dbhost");
	}

	public static function getInstance()
	{
		if (self::$instance == null)
		{
			self::$instance = new MongoDb();
		}
		return self::$instance;
	}

	private function __clone()
	{
		// Stopping Clonning of Object
	}

	private function __wakeup() {
		// Stopping unserialize of object
	}

}