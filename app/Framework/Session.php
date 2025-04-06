<?php

namespace App\Framework;

class Session
{
	private static ?self $instance   = null;
	private bool         $is_started = false;
	private array        $old        = [];

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

	public function error( string $message ): static
	{
		return $this->flash( 'error', $message );
	}

	public function success( string $message ): static
	{
		return $this->flash( 'success', $message );
	}

	public function info( string $message ): static
	{
		return $this->flash( 'info', $message );
	}

	public function redirect( string $route )
	{
		header( 'Location: ' . $route );
		exit;
	}

	public function old( $key ): ?string
	{
		return $this->old[ $key ] ?? null;
	}

	private function flash( string $type, string $message ): static
	{
		$_SESSION[ 'flash_type' ]    = $type;
		$_SESSION[ 'flash_message' ] = $message;

		return $this;
	}

	private function delete_transient_data(): void
	{
		$single_request_keys = [ 'flash_message', 'flash_type' ];
		foreach ( $single_request_keys as $key )
		{
			if ( isset( $_SESSION[ $key ] ) )
			{
				$this->old[ $key ] = $_SESSION[ $key ];
				unset( $_SESSION[ $key ] );
			}
		}
	}
}