<?php

namespace App\Framework;

class Router
{
	private static array $routes = [];

	public static function get( string $name, string $class, string $method ): void
	{
		self::add_route( 'GET', $name, $class, $method );
	}

	public static function post( string $name, string $class, string $method ): void
	{
		self::add_route( 'POST', $name, $class, $method );
	}

	public static function view(): View
	{
		$method = $_SERVER[ "REQUEST_METHOD" ];
		$route  = parse_url( $_SERVER[ "REQUEST_URI" ], PHP_URL_PATH );

		if ( ! array_key_exists( $method, self::$routes ) )
		{
			http_response_code( 404 );

			return View::with( 'errors.404' );
		}
		$registered_routes = self::$routes[ $method ];
		if ( ! array_key_exists( $route, $registered_routes ) )
		{
			http_response_code( 404 );

			return View::with( 'errors.404' );
		}

		[ $class, $method ] = $registered_routes[ $route ];
		$controller = new $class();
		if ( ! method_exists( $controller, $method ) )
		{
			http_response_code( 500 );

			return View::with( 'errors.500' );
		}

		return $controller->{$method}();
	}

	private static function add_route( string $verb, string $name, string $class, string $method ): void
	{
		if ( ! array_key_exists( $verb, self::$routes ) )
		{
			self::$routes[ $verb ] = [];
		}
		self::$routes[ $verb ][ $name ] = [ $class, $method ];
	}
}