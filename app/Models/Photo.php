<?php

namespace App\Models;

use App\Framework\Model;

class Photo extends Model
{
	public static int $max_file_size = 1024 * 1024 * 5;

	public static ?array $allowed_mimes = [ 'image/jpeg', 'image/png', 'image/gif' ];

	protected static ?string $table = 'photos'; // 5MB
}