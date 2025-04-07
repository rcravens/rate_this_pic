<?php

namespace App\Http;

use App\Http\Policies\ReviewPolicy;
use App\Models\Review;

class ReviewController
{
	public function store(): void
	{
		$photo = ReviewPolicy::ensure_photo_exists();

		$data = ReviewPolicy::ensure_valid_data( $photo );

		if ( Review::insert( $data ) === 0 )
		{
			session()->error( 'Oops! Something went wrong adding record to the DB.' )
			         ->redirect( '/photo?id=' . $photo->id );
		}

		session()->success( 'Review has been created.' )
		         ->redirect( '/photo?id=' . $photo->id );
	}
}