<?php

namespace App\Http;

use App\Framework\Database;
use App\Framework\View;
use stdClass;

class PhotoController
{
	public function index(): View
	{
		$db     = Database::instance();
		$sql    = "select * from photos";
		$photos = $db->all( $sql );

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

		$db = Database::instance();

		$sql   = "select * from photos where id = :id";
		$photo = $db->first( $sql, [ 'id' => $id ] );
		if ( is_null( $photo ) )
		{
			return View::with( 'error.404' );
		}

		$sql     = 'select * from reviews where photo_id = :id';
		$reviews = $db->all( $sql, [ 'id' => $id ] );

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
}