<?php

namespace App\Http;

use App\Framework\Database;
use App\Framework\View;

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

		$db    = Database::instance();
		$sql   = "select * from photos where id = :id";
		$photo = $db->first( $sql, [ 'id' => $id ] );
		if ( is_null( $photo ) )
		{
			return View::with( 'error.404' );
		}

		return View::with( 'photo.show' )
		           ->title( 'Rate This Pic' )
		           ->data( [
			                   'photo' => $photo
		                   ] );
	}
}