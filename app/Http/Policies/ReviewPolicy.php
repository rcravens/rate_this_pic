<?php

namespace App\Http\Policies;

use App\Models\Photo;

class ReviewPolicy
{
	public static function ensure_photo_exists(): Photo
	{
		$photo_id = $_GET[ 'id' ] ?? null;
		if ( is_null( $photo_id ) )
		{
			session()->error( 'Missing required parameters.' )->redirect( '/' );
		}

		$photo = Photo::find( $photo_id );
		if ( is_null( $photo ) )
		{
			session()->error( 'Photo not found.' )->redirect( '/' );
		}

		return $photo;
	}

	public static function ensure_valid_data( Photo $photo ): array
	{
		$rating  = validate( 'rating' )->integer()->min( 0 )->max( 5 )->required();
		$name    = validate( 'name' )->string()->max( 100 );
		$comment = validate( 'comment' )->string()->max( 1000 );

		$errors = array_merge( $rating->errors(), $name->errors(), $comment->errors() );
		if ( count( $errors ) > 0 )
		{
			session()->invalid( $errors )->redirect( '/photo?id=' . $photo->id );
		}

		return [
			'photo_id'  => $photo->id,
			'name'      => $name->value(),
			'num_stars' => $rating->value(),
			'comment'   => $comment->value(),
		];
	}

	public static function ensure_ownership( Photo $photo ): void
	{
		$user = session()->user();
		if ( $photo->user_id != $user->id )
		{
			session()->error( 'You do not have permission to delete this photo.' );
		}
	}
}