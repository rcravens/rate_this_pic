<?php use App\Framework\Router;
use App\Http\AboutController;
use App\Http\PhotoController;
use App\Http\UploadController;

Router::get( '/', PhotoController::class, "index" );
Router::get( '/photo', PhotoController::class, "show" );
Router::get( '/upload', UploadController::class, "index" );
Router::get( '/about', AboutController::class, "index" );

Router::post( '/photo', PhotoController::class, "store" );
