<?php

require "../vendor/autoload.php";
require "../app/globals.php";

try
{
	load_route();
}
catch( \Throwable $e )
{
	http_response_code( 500 );
	view( 'errors.500' );
}
