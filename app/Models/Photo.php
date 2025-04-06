<?php

namespace App\Models;

use App\Framework\Model;

class Photo extends Model
{
	public static int $max_file_size = 1024 * 1024 * 5;

	public static ?array $allowed_mimes = [ 'image/jpeg', 'image/png', 'image/gif' ];

	protected static ?string $table = 'photos'; // 5MB

	public static function directory(): string
	{
		$photo_directory = path()->root( 'public/photos/' );
		if ( ! file_exists( $photo_directory ) )
		{
			mkdir( $photo_directory, 0777, true );
		}

		return $photo_directory;
	}

	public static function convert_to_path( $url ): string
	{
		$parts          = explode( '/', $url );
		$filtered_parts = [];
		foreach ( $parts as $part )
		{
			if ( strlen( $part ) > 0 && $part !== 'photos' )
			{
				$filtered_parts[] = $part;
			}
		}

		return static::directory() . implode( '/', $filtered_parts );
	}
}