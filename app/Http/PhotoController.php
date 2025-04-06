<?php

namespace App\Http;

use App\Framework\View;
use App\Models\Photo;
use App\Models\Review;
use stdClass;

class PhotoController
{
	public function index(): View
	{
		$photos = Photo::all();

		return View::with( 'photo.index' )
		           ->title( 'Photo Browser' )
		           ->data( [
			                   'photos' => $photos
		                   ] );
	}

	public function show(): View
	{
		$id = $_GET[ 'id' ];
		if ( is_null( $id ) )
		{
			return View::with( 'error.404' );
		}

		$photo = Photo::find( $id );
		if ( is_null( $photo ) )
		{
			return View::with( 'error.404' );
		}

		$reviews = Review::query()->where( 'photo_id', '=', $id )->get();

		$summary                 = new stdClass();
		$summary->star_total     = 0;
		$summary->star_counts    = [ 0 => 0, 1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0 ];
		$summary->total_comments = 0;
		foreach ( $reviews as $review )
		{
			$summary->star_total                        += $review->num_stars;
			$summary->star_counts[ $review->num_stars ] += 1;
			$summary->total_comments                    += strlen( trim( $review->comment ) ) > 0 ? 1 : 0;
		}
		$summary->avg_star_rating = count( $reviews ) > 0 ? $summary->star_total / count( $reviews ) : 0;

		return View::with( 'photo.show' )
		           ->title( 'Rate This Pic' )
		           ->data( [
			                   'photo'   => $photo,
			                   'summary' => $summary,
			                   'reviews' => $reviews
		                   ] );
	}

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
			session()->invalid( $errors )->redirect_back();
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
			         ->redirect_back();
		}

		session()->success( 'Review has been created.' )
		         ->redirect_back();
	}
}