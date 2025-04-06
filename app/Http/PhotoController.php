<?php

namespace App\Http;

use App\Framework\Database;
use App\Framework\View;

class PhotoController
{
	public function index(): View
	{
		$id = $_GET[ 'id' ] ?? null;
		if ( is_null( $id ) )
		{
			return View::with( 'errors.404' );
		}

		$db = Database::instance();

		$sql    = "select * from photos where id = :id";
		$params = [ 'id' => $id ];

		$photo = $db->first( $sql, $params );

		if ( is_null( $photo ) )
		{
			return View::with( 'errors.404' );
		}

		return View::with( 'photo.index' )
		           ->title( 'Rate This Pic' )
		           ->data( [
			                   'photo' => $photo
		                   ] );
	}
}