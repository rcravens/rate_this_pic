<?php

namespace App\Http;

class AboutController
{
	public function index()
	{
		return view( 'about.index', [
			'page_header' => 'About',
		],           'layout.app' );
	}
}