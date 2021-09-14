<?php

namespace App\Controllers;

class Home extends BaseController {

	public function index() {
		return view('welcome_message');
	}

	public function dameinfo() {
		$data["protegido"] = "SI";
		$data["nombre"] = "Juan Carlos";
		$data["apellido"] = "Villavicencio Barrezueta";
		$data["celular"] = "0999223545";
		die(json_encode($data));
	}

	public function dameinfo2() {
		$data["protegido"] = "NO";
		$data["nombre"] = "Simón";
		$data["apellido"] = "Bolívar";
		$data["celular"] = "0999223545";
		die(json_encode($data));
	}

	public function inforandom() {
		require_once APPPATH . 'ThirdParty/faker/src/autoload.php';
		$faker = \Faker\Factory::create();
		die(var_dump($faker));
		
	}
}
