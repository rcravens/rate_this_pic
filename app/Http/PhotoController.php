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

	public function destroy(): void
	{
		$user = session()->user();
		if ( is_null( $user ) )
		{
			session()->error( 'You must be logged in to delete photos.' );
		}

		$photo = Photo::find( $_GET[ 'id' ] );
		if ( is_null( $photo ) )
		{
			session()->error( 'Photo not found.' )->redirect( '/' );
		}

		if ( $photo->user_id != $user->id )
		{
			session()->error( 'You do not have permission to delete this photo.' );
		}

		$photo_path = Photo::convert_to_path( $photo->url );
		if ( file_exists( $photo_path ) )
		{
			unlink( $photo_path );
		}

		if ( ! Photo::delete( $photo->id ) )
		{
			session()->error( 'Unable to delete photo.' )->redirect_back();
		}

		session()->success( 'Photo deleted successfully.' )->redirect( '/' );
	}
}