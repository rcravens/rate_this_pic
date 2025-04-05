<?php

function dd( $var )
{
	echo "<pre>";
	var_dump( $var );
	echo "</pre>";
	die();
}

function view( $name, array $args = [] )
{
	extract( $args );

	// convention photo.index ===> views/photo/index.view.php
	$parts = explode( '.', $name );
	$path  = '../views/' . implode( '/', $parts ) . '.view.php';

	return require $path;
}

function load_route(): void
{
	$routes = require "../app/routes.php";

	if ( array_key_exists( $_SERVER[ 'REQUEST_URI' ], $routes ) )
	{
		[ $class, $method ] = $routes[ $_SERVER[ 'REQUEST_URI' ] ];
		$controller = new $class();
		if ( method_exists( $controller, $method ) )
		{
			$controller->{$method}();
		}
		else
		{
			dd( 'method ' . $method . ' does not exist' );
		}
	}
	else
	{
		dd( 'route ' . $_SERVER[ 'REQUEST_URI' ] . ' does not exist' );
	}
}