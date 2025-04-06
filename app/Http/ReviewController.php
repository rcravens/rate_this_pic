<?php

namespace App\Http;

use App\Models\Photo;
use App\Models\Review;

class ReviewController
{
	public function store(): void
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

		$rating  = validate( 'rating' )->integer()->min( 0 )->max( 5 )->required();
		$name    = validate( 'name' )->string()->max( 100 );
		$comment = validate( 'comment' )->string()->max( 1000 );

		$errors = array_merge( $rating->errors(), $name->errors(), $comment->errors() );
		if ( count( $errors ) > 0 )
		{
			session()->invalid( $errors )->redirect( '/photo?id=' . $photo_id );
		}

		$data = [
			'photo_id'  => $photo_id,
			'name'      => $name->value(),
			'num_stars' => $rating->value(),
			'comment'   => $comment->value(),
		];
		if ( Review::insert( $data ) === 0 )
		{
			session()->error( 'Oops! Something went wrong adding record to the DB.' )
			         ->redirect( '/photo?id=' . $photo_id );
		}

		session()->success( 'Review has been created.' )
		         ->redirect( '/photo?id=' . $photo_id );
	}
}