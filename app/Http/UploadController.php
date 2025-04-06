<?php

namespace App\Http;

use App\Framework\View;
use App\Models\Photo;

class UploadController
{
	public function index(): View
	{
		return View::with( 'upload.index' )
		           ->title( 'Upload' );
	}

	public function store(): void
	{
		$user = session()->user();
		if ( is_null( $user ) )
		{
			session()->error( 'Must be logged in to upload photos.' )->redirect( '/' );
		}

		$file = validate( 'photo' )->file( Photo::$allowed_mimes )->max( Photo::$max_file_size )->required();

		$errors = $file->errors();
		if ( count( $errors ) > 0 )
		{
			session()->invalid( $errors )->redirect_back();
		}

		$photo_directory = path()->root( 'public/photos' );
		if ( ! file_exists( $photo_directory ) )
		{
			mkdir( $photo_directory, 0777, true );
		}

		$extension   = strtolower( pathinfo( $_FILES[ 'photo' ][ 'name' ], PATHINFO_EXTENSION ) );
		$filename    = uniqid( 'photo_', true ) . '.' . $extension;
		$destination = $photo_directory . '/' . $filename;
		if ( ! move_uploaded_file( $_FILES[ 'photo' ][ 'tmp_name' ], $destination ) )
		{
			session()->error( 'Failed to save the uploaded file.' )->redirect_back();
		}

		$data = [
			'user_id' => $user->id,
			'url'     => '/photos/' . $filename
		];
		if ( Photo::insert( $data ) === 0 )
		{
			session()->error( 'Failed to create photo record.' )->redirect_back();
		}

		session()->success( 'Successfully uploaded file.' )->redirect_back();
	}
}