<?php

function dd( $var )
{
	echo "<pre>";
	var_dump( $var );
	echo "</pre>";
	die();
}

function view( $name, array $args = [] )
{
	extract( $args );
	
	// convention photo.index ===> views/photo/index.view.php
	$parts = explode( '.', $name );
	$path  = '../views/' . implode( '/', $parts ) . '.view.php';

	return require $path;
}