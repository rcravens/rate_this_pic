<?php

namespace App\Http;

use App\Framework\View;

class AboutController
{
	public function index(): View
	{
		return View::with( 'about.index' )
		           ->title( 'About' );
	}
}