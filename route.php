<?php

use App\Http\Controller\SaleController;
use App\Http\Controller\ProductController;
use App\Http\Controller\CategoryController;

$route = new Lib\Route( new Lib\Request() );

// ================================== 
// ROTAS API
$route->post( '/api/sales/store', SaleController::class, 'store' );

// ================================== 
// ROTAS WEB
$route->get( '/', SaleController::class, 'index' );
$route->get( '/sales/create', SaleController::class, 'create' );

$route->get( '/products', ProductController::class, 'index' );
$route->get( '/products/create', ProductController::class, 'create' );
$route->post( '/products/store', ProductController::class, 'store' );
$route->get( '/products/$id/edit', ProductController::class, 'edit' );
$route->post( '/products/$id/update', ProductController::class, 'update' );
$route->post( '/products/$id/delete', ProductController::class, 'delete' );

$route->get( '/categories', CategoryController::class, 'index' );
$route->get( '/categories/create', CategoryController::class, 'create' );
$route->post( '/categories/store', CategoryController::class, 'store' );
$route->get( '/categories/$id/edit', CategoryController::class, 'edit' );
$route->post( '/categories/$id/update', CategoryController::class, 'update' );
$route->post( '/categories/$id/delete', CategoryController::class, 'delete' );
