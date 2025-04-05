<?php

namespace App\Http;

class PhotoController
{
	public function index()
	{
		return view( 'photo.index', [
			'page_header' => 'Rate This Pic',
		] );
	}
}