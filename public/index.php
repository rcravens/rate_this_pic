<?php

use App\Framework\Router;
use App\Framework\View;

const ROOT_PATH = __DIR__ . "/../";

require "../vendor/autoload.php";
require "../app/globals.php";
require "../app/routes.php";

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
