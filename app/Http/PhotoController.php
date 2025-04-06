<?php

namespace App\Http;

use App\Framework\Database;
use App\Framework\View;

class PhotoController
{
	public function index(): View
	{
		$db = Database::instance();

		$sql    = "select * from photos where id = :id";
		$params = [ 'id' => 1 ];

		$photo = $db->first( $sql, $params );

		return View::with( 'photo.index' )
		           ->layout( 'layout.app' )
		           ->title( 'Rate This Pic' )
		           ->data( [
			                   'photo' => $photo
		                   ] );
	}
}