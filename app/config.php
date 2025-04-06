<?php use App\Framework\Env;

return [
	'database' => [
		'host'     => Env::get( "DB_HOST" ),
		'port'     => Env::get( "DB_PORT" ),
		'db_name'  => Env::get( "DB_NAME" ),
		'username' => Env::get( "DB_USER" ),
		'password' => Env::get( "DB_PASS" ),
		'charset'  => 'utf8mb4',
	],
];