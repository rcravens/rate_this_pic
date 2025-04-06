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
		$sql    = "SELECT * FROM photos";
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

		$sql   = "SELECT * FROM photos WHERE id = :id";
		$photo = $db->first( $sql, [ 'id' => $id ] );
		if ( is_null( $photo ) )
		{
			return View::with( 'error.404' );
		}

		$sql     = 'SELECT * FROM reviews WHERE photo_id = :id';
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

	public function store()
	{
		$photo_id = $_GET[ 'id' ] ?? null;
		if ( is_null( $photo_id ) )
		{
			session()->error( 'Missing required parameters.' )->redirect( '/' );
			dd( 'TODO: redirect to home page with a flash message' );
		}

		$db    = Database::instance();
		$sql   = "SELECT * FROM photos WHERE id = :id";
		$photo = $db->first( $sql, [ 'id' => $photo_id ] );
		if ( is_null( $photo ) )
		{
			session()->error( 'Photo not found.' )->redirect( '/' );
		}

		$rating  = $_POST[ 'rating' ] ?? null;          // integer from 0 to 5 inclusive
		$name    = $_POST[ 'name' ] ?? null;            // string (nullable), max length 100
		$comment = $_POST[ 'comment' ] ?? null;         // string (nullable), max length 1000

		$errors = [];

		if ( ! is_numeric( $rating ) || $rating < 0 || $rating > 5 )
		{
			$errors[ 'rating' ] = 'Please enter a valid rating.';
		}
		$rating = intval( $rating );

		$name = htmlspecialchars( trim( $name ) );
		if ( strlen( $name ) > 100 )
		{
			$errors[ 'name' ] = 'Name cannot be longer than 100 characters.';
		}

		$comment = htmlspecialchars( trim( $comment ) );
		if ( strlen( $comment ) > 1000 )
		{
			$errors[ 'comment' ] = 'Comment cannot be longer than 1000 characters.';
		}

		if ( count( $errors ) > 0 )
		{
			session()->invalid( $errors )->redirect_back();
		}

		$sql      = 'INSERT INTO reviews (photo_id, name, num_stars, comment) VALUES (:photo_id, :name, :num_stars, :comment)';
		$db       = Database::instance();
		$num_rows = $db->execute( $sql, [
			'photo_id'  => $photo_id,
			'name'      => $name,
			'num_stars' => $rating,
			'comment'   => $comment
		] );
		if ( $num_rows === 0 )
		{
			session()->error( 'Oops! Something went wrong adding record to the DB.' )
			         ->redirect_back();
		}

		session()->success( 'Review has been created.' )
		         ->redirect_back();
	}
}