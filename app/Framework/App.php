<?php

namespace App\Framework;

class App
{
	private static ?self $instance = null;

	public static function instance(): self
	{
		if ( is_null( self::$instance ) )
		{
			self::$instance = new self();
		}

		return self::$instance;
	}

	public function start(): void
	{
		// Require global helpers
		//
		require "globals.php";

		// Start the PHP session
		//
		session()->start();

		// Load the routes
		//
		path()->require_app( "routes.php" );

		// Load the environment variables
		//
		Env::load( path()->root( '.env' ) );
	}
}