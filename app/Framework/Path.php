<?php

namespace App\Framework;

class Path
{
	private static ?self $instance = null;
	private string       $root_path;
	private string       $app_path;

	public function __construct()
	{
		$this->root_path = __DIR__ . '/../../';
		$this->app_path  = __DIR__ . '/../';
	}

	public static function instance(): Path
	{
		if ( is_null( self::$instance ) )
		{
			self::$instance = new self();
		}

		return self::$instance;
	}

	public function app( string $relative_path ): string
	{
		$relative_path = ltrim( $relative_path, '/' );

		return $this->app_path . $relative_path;
	}

	public function root( string $relative_path ): string
	{
		$relative_path = ltrim( $relative_path, '/' );

		return $this->root_path . $relative_path;
	}

	public function require_app( string $relative_path )
	{
		$path = $this->app( $relative_path );

		return require $path;
	}

	public function require_root( string $relative_path, array $data = [] )
	{
		extract( $data );
		
		$path = $this->root( $relative_path );

		return require $path;
	}
}