<?php

namespace App\Controllers;

use \App\Libraries\Oauth;
use \OAuth2\Request;

use \CodeIgniter\API\ResponseTrait;

class User extends BaseController {
	use ResponseTrait;

	private function getUserDetails($body,$code){
        $body = json_decode($body,true);
        $isLogged = false;
        $userData = null;
        $isAdmin = false;
        $hasTags = null;
        $id = 0;
        $name = null;
        if($code === 200){
            $db = \Config\Database::connect();
            $username = isset($_POST['username']) ? $_POST['username'] : NULL;
            $isLogged = true;
            $query = $db->query("SELECT use_int_id,use_text_name,use_text_lastname,use_int_admin FROM administration.users where use_text_user = '".$username."' LIMIT 1");
            $userData   = $query->getRow();
            $isAdmin = $userData->use_int_admin;
            $tagsQuery = $db->query("select administration.sp_getusertags(".$userData->use_int_id.")");
            $hasTags   = $tagsQuery->getRow()->sp_getusertags;
            $id = $userData->use_int_id;
            $name = $userData->use_text_name . " " .$userData->use_text_lastname;
        }
        $body['isLogged'] = $isLogged;
        $body['userData']['id'] =  $id;
        $body['userData']['name'] =  $name;
        $body['isAdmin'] = $isAdmin;
        $body['hasTags'] = $hasTags;

        return array(
            'body'=> $body,
            'code'=>$code,
        );
    }

	public function login() {
		$oauth = new Oauth();
		$request = new Request();
		$respond = $oauth->server->handleTokenRequest($request->createFromGlobals());
		$code = $respond->getStatusCode();
		$body = $respond->getResponseBody();
		$out = $this->getUserDetails($body,$code);
		return $this->respond($out, $code);
	}

	public function validatetoken(){
        $out = array(
            'body'=> 'Token is valid'
        );
        $code = 200;
        return $this->respond($out, $code);
    }
}