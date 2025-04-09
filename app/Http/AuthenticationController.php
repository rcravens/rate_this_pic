<?php

namespace App\Http;

use App\Framework\View;
use App\Http\Policies\AuthPolicy;
use JetBrains\PhpStorm\NoReturn;

class AuthenticationController
{
	public function login(): View
	{
		return View::with( 'auth.index' )
		           ->title( 'Login' );
	}

	#[NoReturn] public function authenticate(): void
	{
		$user = AuthPolicy::ensure_can_login();

		session()->login( $user->id );
		session()->success( 'Welcome back!' )->redirect( '/' );
	}

	#[NoReturn] public function logout(): void
	{
		session()->logout();
		session()->success( 'You have been logged out!' )->redirect( '/' );
	}
}