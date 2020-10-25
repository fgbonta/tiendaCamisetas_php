<?php

	class Database {
		public static function connect()
		{
			$db = new mysqli('localhost','root','Control12@','master_php');
			$db->query("SET NAMES 'utf8'");
			return $db;
		}
	}

?>