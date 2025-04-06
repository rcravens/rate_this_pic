<?php

namespace App\Http;

use App\Framework\View;

class UploadController
{
	public function index(): View
	{
		return View::with( 'upload.index' )
		           ->title( 'Upload' );
	}
}