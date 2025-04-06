<?php

namespace App\Http;

use App\Framework\View;

class PhotoController
{
	public function index(): View
	{
		return View::with( 'photo.index' )
		           ->layout( 'layout.app' )
		           ->title( 'Rate This Pic' );
	}
}