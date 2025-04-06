<?php use App\Framework\Router;
use App\Http\AboutController;
use App\Http\AuthenticationController;
use App\Http\PhotoController;
use App\Http\RegisterController;
use App\Http\UploadController;

Router::get( '/', PhotoController::class, "index" );
Router::get( '/photo', PhotoController::class, "show" );
Router::post( '/photo', PhotoController::class, "store" );

Router::get( '/upload', UploadController::class, "index" );

Router::get( '/about', AboutController::class, "index" );

Router::get( '/register', RegisterController::class, "index" );
Router::post( '/register', RegisterController::class, "store" );

Router::get( '/login', AuthenticationController::class, "login" );
Router::post( '/login', AuthenticationController::class, "authenticate" );
Router::post( '/logout', AuthenticationController::class, "logout" );
