<?php

use App\Framework\Env;
use App\Framework\Router;
use App\Framework\View;

const ROOT_PATH = __DIR__ . "/../";

require "../vendor/autoload.php";
require "../app/globals.php";
require "../app/routes.php";

Env::load( ROOT_PATH . "/.env" );

$migrate_sql = file_get_contents( ROOT_PATH . "database/migrate.sql" );
$seed_sql    = file_get_contents( ROOT_PATH . "database/seed.sql" );

$host     = Env::get( "DB_HOST" );
$port     = Env::get( "DB_PORT" );
$db_name  = Env::get( "DB_NAME" );
$username = Env::get( "DB_USER" );
$password = Env::get( "DB_PASS" );
$charset  = 'utf8mb4';

$dsn = "mysql:host=$host;port=$port;dbname=$db_name;charset=$charset";

$options = [
	PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
	PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
	PDO::ATTR_EMULATE_PREPARES   => false,
];

try
{
	$pdo = new PDO( $dsn, $username, $password, $options );
	$pdo->exec( $migrate_sql );
	$pdo->exec( $seed_sql );
}
catch( \PDOException $e )
{
	dd( $e->getMessage() );
}


dd( 'here' );

try
{
	$view = Router::view();
	$view->render();
}
catch( \Throwable $e )
{
	http_response_code( 500 );
	View::with( 'errors.500' );
}
