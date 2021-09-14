<?php
if(!isset($routes)){ 
    $routes = \Config\Services::routes(true);
}

$routes->group('api', ['namespace' => 'Modules\Api\Controllers'], function($subroutes){
    $subroutes->add('', 'Api::index');
    $subroutes->add('access_users', 'Api::access_users');
    $subroutes->add('access_groups', 'Api::access_groups');
    $subroutes->add('getLanguageStrings', 'Api::getLanguageStrings');
    
    $subroutes->resource('api');

    global $protected,$public,$scope;
    $scope = 'api';
    $protected[$scope] = array(
        'documents',
        'authors',
        'categories'
    );
    $public[$scope] = array(
        'getLanguageStrings'
    );

});