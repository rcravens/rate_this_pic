<?php

namespace App\Http\Policies;

use App\Models\User;

class UserPolicy
{
	public static function ensure_valid_data(): array
	{
		$name     = validate( 'name' )->string()->min( 5 )->max( 100 )->required();
		$email    = validate( 'email' )->email()->max( 255 )->unique( User::class, 'email' )->required();
		$password = validate( 'password' )->string()->min( 6 )->max( 255 )->confirm( 'password_confirmation' )->required();

		$errors = array_merge( $name->errors(), $email->errors(), $password->errors() );
		if ( count( $errors ) > 0 )
		{
			session()->invalid( $errors )->redirect_back();
		}

		return [
			'name'     => $name->value(),
			'email'    => $email->value(),
			'password' => password_hash( $password->value(), PASSWORD_DEFAULT ),
		];
	}
}