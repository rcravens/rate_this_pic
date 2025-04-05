<?php

namespace App\Http;

class UploadController
{
	public function index()
	{
		return view( 'upload.index', [
			'page_header' => 'Upload',
		],           'layout.app' );
	}
}