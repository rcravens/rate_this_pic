<?php

require "../vendor/autoload.php";
require "../app/globals.php";

try
{
	$view = load_route();
	$view->render();
}
catch( \Throwable $e )
{
	dd( $e->getMessage() );
	http_response_code( 500 );
	view( 'errors.500' );
}
