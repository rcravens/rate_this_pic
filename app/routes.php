<?php use App\Http\AboutController;
use App\Http\PhotoController;
use App\Http\UploadController;

return [
	'/'       => [ PhotoController::class, "ssss" ],
	'/upload' => [ UploadController::class, "index" ],
	'/about'  => [ AboutController::class, "index" ],
];