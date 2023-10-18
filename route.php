<?php

use App\Http\Controller\ProductController;

$route = new Lib\Route( new Lib\Request() );

$route->get( '/', ProductController::class, 'index' );
