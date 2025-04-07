<?php

namespace App\Http\Policies;

use App\Models\Photo;
use App\Models\User;

class PhotoPolicy
{
	public static function ensure_authenticated(): User
	{
		$user = session()->user();
		if ( is_null( $user ) )
		{
			session()->error( 'You must be logged in to delete photos.' );
		}

		return $user;
	}

	public static function ensure_exists( Photo $photo ): void
	{
		$photo = Photo::find( $_GET[ 'id' ] );
		if ( is_null( $photo ) )
		{
			session()->error( 'Photo not found.' )->redirect( '/' );
		}
	}

	public static function ensure_ownership( Photo $photo ): void
	{
		$user = session()->user();
		if ( $photo->user_id != $user->id )
		{
			session()->error( 'You do not have permission to delete this photo.' );
		}
	}

	public static function ensure_upload_success( User $user ): array
	{
		$file = validate( 'photo' )->file( Photo::$allowed_mimes )->max( Photo::$max_file_size )->required();

		$errors = $file->errors();
		if ( count( $errors ) > 0 )
		{
			session()->invalid( $errors )->redirect_back();
		}

		$photo_directory = Photo::directory();

		$extension   = strtolower( pathinfo( $_FILES[ 'photo' ][ 'name' ], PATHINFO_EXTENSION ) );
		$filename    = uniqid( 'photo_', true ) . '.' . $extension;
		$destination = $photo_directory . '/' . $filename;
		if ( ! move_uploaded_file( $_FILES[ 'photo' ][ 'tmp_name' ], $destination ) )
		{
			session()->error( 'Failed to save the uploaded file.' )->redirect_back();
		}

		return [
			'user_id' => $user->id,
			'url'     => '/photos' . $filename
		];
	}
}