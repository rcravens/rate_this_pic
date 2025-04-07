<?php

namespace App\Http;

use App\Framework\View;
use App\Http\Policies\AuthPolicy;

class AuthenticationController
{
	public function login(): View
	{
		return View::with( 'auth.index' )
		           ->title( 'Login' );
	}

	public function authenticate(): void
	{
		$user = AuthPolicy::ensure_can_login();

		session()->login( $user->id );
		session()->success( 'Welcome back!' )->redirect( '/' );
	}

	public function logout(): void
	{
		session()->logout();
		session()->success( 'You have been logged out!' )->redirect( '/' );
	}
}