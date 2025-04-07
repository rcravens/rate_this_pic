<?php

namespace App\Http\Policies;

use App\Models\User;

class AuthPolicy
{
	public static function ensure_can_login(): User
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

		return $user;
	}
}