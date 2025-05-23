<?php

use App\Framework\App;
use App\Framework\Router;

require "../vendor/autoload.php";
App::instance()->start();

try
{
	$view = Router::view();
	$view->render();
}
catch( \Throwable $e )
{
	dd( $e );
//	http_response_code( 500 );
//	View::with( 'errors.500' );
}
