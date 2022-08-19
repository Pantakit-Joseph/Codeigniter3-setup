<?php

if (!function_exists('env')) {
	function env($key, $default = null)
	{
		$value = getenv($key);
		if ($value === false) {
			return $default;
		}
		switch (strtolower($value)) {
			case 'true':
			case '(true)':
				return true;
			case 'false':
			case '(false)':
				return false;
			case 'empty':
			case '(empty)':
				return '';
			case 'null':
			case '(null)':
				return;
		}
		if (strlen($value) > 1 && strpos($value, '"') === 0) {
			return substr($value, 1, -1);
		}
		return $value;
	}
}

if (file_exists(__DIR__ . "/.env")) {
	$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
	$dotenv->load();
}
