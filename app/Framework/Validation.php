<?php

namespace App\Framework;

class Validation
{
	private string $name;
	private mixed  $value;
	private mixed  $clean_value;
	private bool   $is_file = false;

	private array $errors = [];

	public function __construct( string $name )
	{
		$this->name        = $name;
		$this->value       = $_POST[ $name ] ?? null;
		$this->clean_value = $this->clean_value( $this->value );
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

	public function email(): Validation
	{
		if ( filter_var( $this->clean_value, FILTER_VALIDATE_EMAIL ) === false )
		{
			$this->errors[ $this->name ] = 'Please enter a valid email address.';
		}

		return $this;
	}

	public function integer(): Validation
	{
		if ( ! is_numeric( $this->clean_value ) )
		{
			$this->errors[ $this->name ] = 'Please enter a valid number.';

			return $this;
		}

		$this->clean_value = intval( $this->clean_value );

		return $this;
	}

	public function file( array $allowed_mimes = null ): Validation
	{
		$this->value       = $_FILES[ $this->name ] ?? null;
		$this->clean_value = $this->value;
		$this->is_file     = true;

		if ( is_null( $this->value ) )
		{
			$this->errors[ $this->name ] = 'Please upload a file.';

			return $this;
		}

		if ( ! is_null( $allowed_mimes ) )
		{
			$mime_type = mime_content_type( $this->clean_value[ 'tmp_name' ] );
			if ( ! in_array( $mime_type, $allowed_mimes ) )
			{
				$this->errors[ $this->name ] = 'Please upload a file of type: ' . implode( ', ', $allowed_mimes );

				return $this;
			}
		}

		return $this;
	}

	public function min( int $min ): Validation
	{
		if ( is_null( $this->clean_value ) )
		{
			return $this;
		}

		if ( ! $this->is_file )
		{
			if ( is_string( $this->clean_value ) && strlen( $this->clean_value ) < $min )
			{
				$this->errors[ $this->name ] = 'Must be at least ' . $min . ' characters.';

				return $this;
			}

			if ( is_numeric( $this->clean_value ) && $this->clean_value < $min )
			{
				$this->errors[ $this->name ] = 'Must be at least ' . $min . '.';

				return $this;
			}
		}
		else
		{
			if ( $this->clean_value[ 'size' ] < $min )
			{
				$this->errors[ $this->name ] = 'Must be at least ' . $min . ' bytes.';

				return $this;
			}
		}

		return $this;
	}

	public function max( int $max ): Validation
	{
		if ( is_null( $this->clean_value ) )
		{
			return $this;
		}

		if ( ! $this->is_file )
		{
			if ( is_string( $this->clean_value ) && strlen( $this->clean_value ) > $max )
			{
				$this->errors[ $this->name ] = 'Cannot be more than ' . $max . ' characters.';

				return $this;
			}

			if ( is_numeric( $this->clean_value ) && $this->clean_value > $max )
			{
				$this->errors[ $this->name ] = 'Cannot be greater than ' . $max . '.';

				return $this;
			}
		}
		else
		{
			if ( $this->clean_value[ 'size' ] > $max )
			{
				$this->errors[ $this->name ] = 'Must be less than ' . $max . ' bytes.';

				return $this;
			}
		}

		return $this;
	}

	public function required(): Validation
	{
		if ( is_null( $this->clean_value ) )
		{
			$this->errors[ $this->name ] = 'Value is required.';
		}

		return $this;
	}

	public function confirm( $confirm_name ): Validation
	{
		$confirm_value = $_POST[ $confirm_name ] ?? null;
		$confirm_value = $this->clean_value( $confirm_value );
		if ( $confirm_value !== $this->clean_value )
		{
			$this->errors[ $this->name ] = 'Please enter a matching confirmation value.';
		}

		return $this;
	}

	public function unique( string $model_class_name, string $column, int $excluded_id = null ): Validation
	{
		if ( ! $model_class_name::unique( $column, $this->clean_value, $excluded_id ) )
		{
			$this->errors[ $this->name ] = 'Value is already in use.';
		}

		return $this;
	}

	private function clean_value( ?string $value ): ?string
	{
		if ( is_null( $value ) )
		{
			return null;
		}

		return htmlspecialchars( trim( $value ) );
	}
}