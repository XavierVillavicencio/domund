<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

use \App\Libraries\Oauth;
use \App\Libraries\Logs;

use \OAuth2\Request;
use \OAuth2\Response;

class OauthFilter implements FilterInterface {

    public function before(RequestInterface $request, $arguments = null) {
//        $oauth = new Oauth();
//        $request = Request::createFromGlobals();
//        $response = new Response();
//
//        // check if the user is valid access token
//        if (!$oauth->server->verifyResourceRequest($request)) {
//            $oauth->server->getResponse()->send();
//            die();
//        }
        //$token = $oauth->server->getAccessTokenData($request);
        // almacena logs y genera variables del usuario

    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null) {
        
        // hacer alguito
        die("hasta aqui after del oauthFuilter");
    }
}
