<?php

use App\Framework\View;

function dd( ...$vars )
{
	echo "<pre>";
	foreach ( $vars as $var )
	{
		var_dump( $var );
	}
	echo "</pre>";
	die();
}

function load_route()
{
	$routes = require "../app/routes.php";

	if ( array_key_exists( $_SERVER[ 'REQUEST_URI' ], $routes ) )
	{
		[ $class, $method ] = $routes[ $_SERVER[ 'REQUEST_URI' ] ];
		$controller = new $class();
		if ( method_exists( $controller, $method ) )
		{
			return $controller->{$method}();
		}
		else
		{
			http_response_code( 500 );

			return View::with( 'errors.500' );
		}
	}
	else
	{
		http_response_code( 404 );

		return View::with( 'errors.404' );
	}
}