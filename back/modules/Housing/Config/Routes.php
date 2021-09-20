<?php
global $routes;
if (!isset($routes)) {
    $routes = \Config\Services::routes(true);
}

$routes->group('housing', ['namespace' => 'Modules\Housing\Controllers'], function ($subroutes) {
    /*** Rutas para arquitectura HMVC vistas simples ***/
    $subroutes->add('', 'housing::index');
    $subroutes->add('condos', 'Condos::index');

    global $protected,$public,$scope;
    $scope = 'housing';
    $protected[$scope] = array(
        'condos'
        );

    $public[$scope] = array(
        'public'
    );
    foreach (array_merge($protected[$scope],$public[$scope]) as $tag) {
        $subroutes->resource($tag);
    }
});
