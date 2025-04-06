<?php

use App\Framework\Path;

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

function path(): Path
{
	return Path::instance();
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