<?php

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

function view( $name, array $args = [], $page_layout = null )
{
	// convention photo.index ===> views/photo/index.view.php
	$parts = explode( '.', $name );
	$path  = '../views/' . implode( '/', $parts ) . '.view.php';

	if ( isset( $page_layout ) )
	{
		$args[ 'page_content' ] = file_get_contents( $path );

		return view( $page_layout, $args );
	}

	extract( $args );

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
			http_response_code( 500 );
			view( 'errors.500' );
		}
	}
	else
	{
		http_response_code( 404 );
		view( 'errors.404', [] );
	}
}