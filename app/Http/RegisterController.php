<?php

namespace App\Http;

use App\Framework\View;
use App\Http\Policies\UserPolicy;
use App\Models\User;
use JetBrains\PhpStorm\NoReturn;

class RegisterController
{
	public function index(): View
	{
		return View::with( 'registration.index' )
		           ->title( 'Registration' );
	}

	#[NoReturn] public function store(): void
	{
		$data = UserPolicy::ensure_valid_data();

		if ( User::insert( $data ) === 0 )
		{
			session()->error( 'Oops! Something went wrong adding record to the DB.' )
			         ->redirect_back();
		}

		session()->success( 'Account has been created.' )
		         ->redirect( '/login' );
	}
}