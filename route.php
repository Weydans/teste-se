<?php

use App\Http\Controller\ProductController;

$route = new Lib\Route( new Lib\Request() );

$route->get( '/products', ProductController::class, 'index' );
$route->get( '/products/create', ProductController::class, 'create' );
$route->get( '/products/$id/edit', ProductController::class, 'edit' );
