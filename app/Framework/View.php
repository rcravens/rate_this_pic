<?php

namespace App\Framework;

class View
{
	private string  $view;
	private ?string $layout = 'layout.app';
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

	public function render(): void
	{
		$view_path = $this->get_path( $this->view );

		if ( ! is_null( $this->layout ) && $this->view != $this->layout )
		{
			$this->data[ '_page_content' ] = $this->render_template( $view_path, $this->data );
			View::with( $this->layout )
			    ->data( $this->data )
			    ->render();

			return;
		}

		$html = $this->render_template( $view_path, $this->data );

		echo $html;
	}

	private function render_template( string $view_path, array $data ): string
	{
		$template = file_get_contents( $view_path );

		// Support {{ $var }}
		//
		$template = preg_replace( '/\{\{\s*(.+?)\s*}}/', '<?= htmlspecialchars($1) ?>', $template );

		// Support {!! $var !!}
		//
		$template = preg_replace( '/\{!!\s*(.+?)\s*!!}/', '<?= $1 ?>', $template );

		extract( $data );

		// Start output buffering
		//
		ob_start();

		// Evaluate PHP inside the template
		//
		eval( '?>' . $template );

		// Capture and return the output buffer as a string
		//
		return ob_get_clean();
	}

	private function get_path( $short_notation ): string
	{
		// convention photo.index ===> views/photo/index.view.php
		$parts = explode( '.', $short_notation );

		return '../views/' . implode( '/', $parts ) . '.view.php';
	}
}