<?php

use App\Framework\Path;
use App\Framework\Session;
use App\Framework\Validation;
use JetBrains\PhpStorm\NoReturn;

#[NoReturn] function dd( ...$vars ): void
{
	echo "<pre>";
	foreach ( $vars as $var )
	{
		var_dump( $var );
	}
	echo "</pre>";
	die();
}

function path(): Path
{
	return Path::instance();
}

function session(): Session
{
	return Session::instance();
}

function validate( string $name ): Validation
{
	return new Validation( $name );
}

function config( $short_hand )
{
	$config = path()->require_app( 'config.php' );
	$parts  = explode( '.', $short_hand );
	foreach ( $parts as $part )
	{
		if ( ! array_key_exists( $part, $config ) )
		{
			return null;
		}
		$config = $config[ $part ];
	}

	return $config;
}