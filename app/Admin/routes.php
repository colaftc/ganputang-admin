<?php

use Illuminate\Routing\Router;

Admin::registerHelpersRoutes();

Route::group([
    'prefix'        => config('admin.prefix'),
    'namespace'     => Admin::controllerNamespace(),
    'middleware'    => ['web', 'admin'],
], function (Router $router) {

    $router->get('/', 'HomeController@index');
    $router->resource('product-type',ProductTypeController::class);
    $router->resource('supplier',SupplierController::class);
    $router->resource('product',ProductController::class);
    $router->resource('shop',ShopController::class);
    $router->resource('expenses_type',ExpensesTypeController::class);
    $router->resource('expenditure',ExpenditureController::class);
});
