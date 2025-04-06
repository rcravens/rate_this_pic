<?php

namespace App\Code;

class Gravatar
{
	public static function url( string $email, int $size = 80, string $default = 'mp', string $rating = 'g' ): string
	{
		$emailHash = md5( strtolower( trim( $email ) ) );
		$params    = http_build_query( [
			                               's' => $size,
			                               'd' => $default,
			                               'r' => $rating,
		                               ] );

		return "https://www.gravatar.com/avatar/{$emailHash}?{$params}";
	}
}