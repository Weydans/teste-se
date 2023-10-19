<?php

use App\Http\Controller\ProductController;
use App\Http\Controller\CategoryController;

$route = new Lib\Route( new Lib\Request() );

$route->get( '/products', ProductController::class, 'index' );
$route->get( '/products/create', ProductController::class, 'create' );
$route->get( '/products/$id/edit', ProductController::class, 'edit' );

$route->get( '/categories', CategoryController::class, 'index' );
$route->get( '/categories/create', CategoryController::class, 'create' );
$route->get( '/categories/id/edit', CategoryController::class, 'edit' );
