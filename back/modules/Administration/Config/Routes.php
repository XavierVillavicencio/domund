<?php
global $routes;
if (!isset($routes)) {
    $routes = \Config\Services::routes(true);
}

$routes->group('administration', ['namespace' => 'Modules\Administration\Controllers'], function ($subroutes) {
    /*** Rutas para arquitectura HMVC vistas simples ***/
    $subroutes->add('', 'Administration::index');
    $subroutes->add('users', 'Users::index');
    $subroutes->add('groups', 'Groups::index');
    $subroutes->add('access', 'Access::index');
    $subroutes->add('business', 'Business::index');
    $subroutes->add('customers', 'Customers::index');
    $subroutes->add('access_groups', 'Access_goups::index');
    $subroutes->add('follow', 'Follow::index');
    $subroutes->add('groups_users', 'Goups_users::index');
    $subroutes->add('business_users', 'Business_users::index');
    $subroutes->add('business_customers', 'Business_customers::index');
    $subroutes->add('vwlistbusinessusers', 'VwListBusinessUsers::index');
    $subroutes->add('vwlistbusinesscustomers', 'VwListBusinessCustomers::index');
    $subroutes->add('vwlistgroupsusers', 'VwListGroupsUsers::index');
    $subroutes->add('vwlistaccessusers', 'VwListAccessUsers::index');
    $subroutes->add('vwlistaccessgroups', 'VwListAccessGroups::index');
    $subroutes->add('vwlistgroupsaccess', 'VwListGroupsAccess::index');
    $subroutes->add('vwlistfollowusers', 'VwListFollowUsers::index');
    $subroutes->add('access_users', 'Access_users::index');
    $subroutes->add('topics', 'Topics::index');
    $subroutes->add('files_business', 'Files_business::index');
    $subroutes->add('files', 'Files::show');
    $subroutes->add('files_issues', 'Files_issues::index');
    $subroutes->add('files_topics', 'Files_topics::index');
    $subroutes->add('files_users', 'Files_users::index');
    $subroutes->add('files_customers', 'Files_customers::index');
    $subroutes->add('files_follow', 'Files_follow::index');
    $subroutes->add('issues', 'Issues::index');
    $subroutes->add('logs', 'Logs::index');
    global $protected,$public,$scope;
    $scope = 'administration';
    $protected[$scope] = array(
        'users',
        'vw_listusergroups',
        'sp_listusergroups',
        'vw_listuseraccess',
        'sp_listuseraccess',
        'vw_listuseraccessgroups',
        'groups',
        'vw_listgroupaccess',
        'sp_listgroupaccess',
        'vw_listgroupusers',
        'sp_listgroupusers',
        'access',
        'vw_listaccessgroups',
        'sp_listaccessgroups',
        'vw_listaccessusers',
        'sp_listaccessusers',
        'business',
        'vw_listbusinessusers',
        'sp_listbusinessusers',
        'files_business',
        'files_users',
        'logs',
        'languages',
        'countries',
        'intranet',
    );

    $public[$scope] = array(
        'public'
    );
    foreach (array_merge($protected[$scope],$public[$scope]) as $tag) {
        $subroutes->resource($tag);
    }
});
