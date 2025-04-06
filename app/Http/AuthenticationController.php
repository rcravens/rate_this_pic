<?php

namespace App\Http;

use App\Framework\View;
use App\Models\User;

class AuthenticationController
{
	public function login(): View
	{
		return View::with( 'auth.index' )
		           ->title( 'Login' );
	}

	public function authenticate(): void
	{
		$email    = validate( 'email' )->email()->max( 255 )->required();
		$password = validate( 'password' )->string()->min( 6 )->max( 255 )->required();

		$errors = array_merge( $email->errors(), $password->errors() );
		if ( count( $errors ) > 0 )
		{
			session()->invalid( $errors )->redirect_back();
		}

		$user = User::query()->where( 'email', '=', $email->value() )->first();
		if ( is_null( $user ) || ! password_verify( $password->value(), $user->password ) )
		{
			session()->error( 'Invalid email or password' )->redirect_back();
		}

		session()->login( $user->id );
		session()->success( 'Welcome back!' )->redirect( '/' );
	}

	public function logout(): void
	{
		session()->logout();
		session()->success( 'You have been logged out!' )->redirect( '/' );
	}
}