<?php

namespace App\Http;

use App\Framework\View;
use App\Http\Policies\PhotoPolicy;
use App\Models\Photo;
use JetBrains\PhpStorm\NoReturn;

class UploadController
{
	public function index(): View
	{
		return View::with( 'upload.index' )
		           ->title( 'Upload' );
	}

	#[NoReturn] public function store(): void
	{
		$user = PhotoPolicy::ensure_authenticated();

		$data = PhotoPolicy::ensure_upload_success( $user );

		if ( Photo::insert( $data ) === 0 )
		{
			session()->error( 'Failed to create photo record.' )->redirect_back();
		}

		session()->success( 'Successfully uploaded file.' )->redirect_back();
	}
}