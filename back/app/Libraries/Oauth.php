<?php

namespace App\Libraries;

require_once APPPATH . 'ThirdParty/oauth2-server-php/src/OAuth2/Autoloader.php';

use \OAuth2;

OAuth2\Autoloader::register();

use OAuth2\Request;
use \OAuth2\Storage\Pdo;



class Oauth
{
    var $server;

    function __construct()
    {
        $this->init();
    }

    public function init()
    {
        $dsn = getenv('database.default.DSN');
        $password = getenv('database.default.password');
        $username = getenv('database.default.username');
        $storage = new Pdo(['dsn' => $dsn, 'username' => $username, 'password' => $password]);

        $this->server = new \OAuth2\Server($storage);
        $this->server->addGrantType(new \OAuth2\GrantType\RefreshToken($storage), ['always_issue_new_refresh_token' => true]);
        $this->server->addGrantType(new \OAuth2\GrantType\UserCredentials($storage));
    }

    public function getTokenUser()
    {
        //$oauth = new Oauth();
        //$request = Request::createFromGlobals();
        //$out = $oauth->server->getAccessTokenData($request);



        $out = Array(
                        "access_token" => "71aeea55e7e9b993ea0646a6454e11059577f6dd",
                        "client_id" => "testclient",
                        "user_id" => "juancarlos@correovirtual.com",
                        "expires" => "1617894328",
                        "scope" => "app"
                        );
        return $out;
    }

    public function getUserDetails($body)
    {
        global $getUserDetails;

        if(empty($body)){
            return null;
        }

        if(!empty($getUserDetails)){
            return $getUserDetails;
        }
        $userData = null;
        $hasTags = null;
        $name = null;
        $db = \Config\Database::connect();
        $username = $body['user_id'];
        $query = $db->query("select administration.sp_savelog('288ff3a5fcddf4e8625d8011737af6109e058844')");
        $userData = $query->getRow();
        $isAdmin = $userData->use_int_admin;
        $body['isAdmin'] = $isAdmin;
        $body['hasTags'] = $userData->sp_getusertags;
        $body['use_int_id'] = $userData->use_int_id;
        $body['use_text_name'] = $userData->use_text_name;
        $body['use_text_lastname'] = $userData->use_text_lastname;
        $body['use_int_admin'] = $userData->use_int_admin;
        $getUserDetails = $body;
        return $body;
    }

    public function getUserDetailsToken()
    {
        global $userData;
        if (empty($userData)) {
            die ('something when wrong with userdetailstoekn');
        } else {
            return $userData;
        }
    }
}
