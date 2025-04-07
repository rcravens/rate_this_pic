<?php

namespace App\Framework;

use App\Models\User;

class Session
{
	private static ?self $instance   = null;
	private bool         $is_started = false;
	private array        $flash      = [];
	private array        $old        = [];
	private array        $errors     = [];

	public static function instance(): self
	{
		if ( is_null( self::$instance ) )
		{
			self::$instance = new self();
		}

		return self::$instance;
	}

	public function start(): bool
	{
		if ( ! $this->is_started )
		{
			$this->is_started = session_start();

			if ( isset( $_SESSION ) )

			{
				$this->delete_transient_data();
			}
		}

		return $this->is_started;
	}

	public function login( $user_id ): void
	{
		$_SESSION[ 'user_id' ] = $user_id;
	}

	public function logout(): void
	{
		session_destroy();
	}

	public function guest(): bool
	{
		return ! isset( $_SESSION[ 'user_id' ] );
	}

	public function user(): ?User
	{
		if ( $this->guest() )
		{
			return null;
		}

		return User::find( $_SESSION[ 'user_id' ] );
	}

	public function error( string $message ): static
	{
		return $this->create_flash( 'error', $message );
	}

	public function success( string $message ): static
	{
		return $this->create_flash( 'success', $message );
	}

	public function info( string $message ): static
	{
		return $this->create_flash( 'info', $message );
	}

	public function invalid( array $errors ): static
	{
		$_SESSION[ 'old' ] = $_POST;

		$_SESSION[ 'errors' ] = $errors;

		return $this;
	}

	public function redirect( string $route )
	{
		header( 'Location: ' . $route );
		exit;
	}

	public function redirect_back()
	{
		$this->redirect( Router::current_route() );
	}

	public function old( $key, $default = null ): string
	{
		$val = $this->old[ $key ] ?? $default;

		return htmlspecialchars( $val );
	}

	public function validation_message( $key ): ?string
	{
		return $this->errors[ $key ] ?? null;
	}

	public function flash(): ?string
	{
		$msg = $this->flash[ 'flash_message' ] ?? null;

		return htmlspecialchars( $msg );
	}

	public function flash_type(): ?string
	{
		return $this->flash[ 'flash_type' ] ?? null;
	}

	private function create_flash( string $type, string $message ): static
	{
		$_SESSION[ 'flash_type' ]    = $type;
		$_SESSION[ 'flash_message' ] = $message;

		return $this;
	}

	private function delete_transient_data(): void
	{
		$flash_keys = [ 'flash_message', 'flash_type' ];
		foreach ( $flash_keys as $key )
		{
			if ( isset( $_SESSION[ $key ] ) )
			{
				$this->flash[ $key ] = $_SESSION[ $key ];
				unset( $_SESSION[ $key ] );
			}
		}

		if ( isset( $_SESSION[ 'old' ] ) )
		{
			$this->old = $_SESSION[ 'old' ];
			unset( $_SESSION[ 'old' ] );
		}
		if ( isset( $_SESSION[ 'errors' ] ) )
		{
			$this->errors = $_SESSION[ 'errors' ];
			unset( $_SESSION[ 'errors' ] );
		}
	}
}