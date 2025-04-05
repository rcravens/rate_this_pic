<?php use App\Http\AboutController;
use App\Http\PhotoController;
use App\Http\UploadController;

return [
	'/'       => [ PhotoController::class, "index" ],
	'/upload' => [ UploadController::class, "index" ],
	'/about'  => [ AboutController::class, "index" ],
];