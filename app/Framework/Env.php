<?php

namespace App\Framework;

use http\Exception\RuntimeException;

class Env
{
	private static array $vars = [];

	public static function load( string $env_file ): void
	{
		if ( ! file_exists( $env_file ) )
		{
			throw new RuntimeException( "Env file does not exist: $env_file" );
		}

		$lines = file( $env_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES );

		foreach ( $lines as $line )
		{
			if ( str_starts_with( $line, '#' ) )
			{
				continue;
			}

			[ $key, $value ] = explode( '=', $line, 2 );
			self::$vars[ trim( $key ) ] = trim( $value );
		}
	}

	public static function get( string $key, mixed $default = null ): mixed
	{
		return self::$vars[ $key ] ?? $default;
	}
}