<?php

namespace App\Framework;

class Validation
{
	private string $name;
	private mixed  $value;
	private mixed  $clean_value;

	private array $errors = [];

	public function __construct( string $name )
	{
		$this->name        = $name;
		$this->value       = $_POST[ $name ] ?? null;
		$this->clean_value = htmlspecialchars( $this->value );
	}

	public function value(): mixed
	{
		return $this->clean_value;
	}

	public function errors(): array
	{
		return $this->errors;
	}

	public function string(): Validation
	{
		if ( ! is_string( $this->value ) )
		{
			$this->errors[ $this->name ] = 'Please enter a valid string value.';
		}

		return $this;
	}

	public function integer(): Validation
	{
		if ( ! is_numeric( $this->value ) )
		{
			$this->errors[ $this->name ] = 'Please enter a valid number.';

			return $this;
		}

		$this->clean_value = intval( $this->clean_value );

		return $this;
	}

	public function min( int $min ): Validation
	{
		if ( is_null( $this->value ) )
		{
			return $this;
		}

		if ( is_string( $this->value ) && strlen( $this->value ) < $min )
		{
			$this->errors[ $this->name ] = 'Must be at least ' . $min . ' characters.';

			return $this;
		}

		if ( is_numeric( $this->value ) && $this->value < $min )
		{
			$this->errors[ $this->name ] = 'Must be at least ' . $min . '.';

			return $this;
		}

		return $this;
	}

	public function max( int $max ): Validation
	{
		if ( is_null( $this->value ) )
		{
			return $this;
		}

		if ( is_string( $this->value ) && strlen( $this->value ) > $max )
		{
			$this->errors[ $this->name ] = 'Cannot be more than ' . $max . ' characters.';

			return $this;
		}

		if ( is_numeric( $this->value ) && $this->value > $max )
		{
			$this->errors[ $this->name ] = 'Cannot be greater than ' . $max . '.';

			return $this;
		}

		return $this;
	}

	public function required(): Validation
	{
		if ( is_null( $this->value ) )
		{
			$this->errors[ $this->name ] = 'Value is required.';
		}

		return $this;
	}
}