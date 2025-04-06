<?php

use App\Framework\App;
use App\Framework\Router;
use App\Framework\View;

require "../vendor/autoload.php";
App::instance()->start();

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
