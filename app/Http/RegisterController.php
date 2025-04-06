<?php

namespace App\Http;

use App\Framework\View;
use App\Models\User;

class RegisterController
{
	public function index(): View
	{
		return View::with( 'registration.index' )
		           ->title( 'Registration' );
	}

	public function store(): void
	{
		$name     = validate( 'name' )->string()->min( 5 )->max( 100 )->required();
		$email    = validate( 'email' )->email()->max( 255 )->unique( User::class, 'email' )->required();
		$password = validate( 'password' )->string()->min( 6 )->max( 255 )->confirm( 'password_confirmation' )->required();

		$errors = array_merge( $name->errors(), $email->errors(), $password->errors() );
		if ( count( $errors ) > 0 )
		{
			session()->invalid( $errors )->redirect_back();
		}

		$data = [
			'name'     => $name->value(),
			'email'    => $email->value(),
			'password' => password_hash( $password->value(), PASSWORD_DEFAULT ),
		];
		if ( User::insert( $data ) === 0 )
		{
			session()->error( 'Oops! Something went wrong adding record to the DB.' )
			         ->redirect_back();
		}

		session()->success( 'Account has been created.' )
		         ->redirect( '/login' );
	}
}