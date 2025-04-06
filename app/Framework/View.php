<?php

namespace App\Framework;

class View
{
	private string  $view;
	private ?string $layout = null;
	private array   $data   = [];

	public function __construct( $view )
	{
		$this->view = $view;
	}

	public static function with( string $view ): View
	{
		return new self( $view );
	}

	public function layout( $layout ): static
	{
		$this->layout = $layout;

		return $this;
	}

	public function title( $title ): static
	{
		$this->data[ '_page_header' ] = $title;

		return $this;
	}

	public function data( array $data ): static
	{
		$this->data = array_merge( $this->data, $data );

		return $this;
	}

	public function render()
	{
		$view_path = $this->get_path( $this->view );

		if ( ! is_null( $this->layout ) )
		{
			$this->data[ '_page_content' ] = file_get_contents( $view_path );

			return View::with( $this->layout )
			           ->data( $this->data )
			           ->render();
		}

		extract( $this->data );

		return require $view_path;
	}

	private function get_path( $short_notation )
	{
		// convention photo.index ===> views/photo/index.view.php
		$parts = explode( '.', $short_notation );

		return '../views/' . implode( '/', $parts ) . '.view.php';
	}
}