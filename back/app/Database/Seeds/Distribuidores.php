<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

require_once APPPATH . 'ThirdParty/faker/src/autoload.php';

class Distribuidores extends Seeder {

	public function run() {
		/*
		- Para crear el seeder
		php spark make:seeder
		 
		- en linea de comando correr 
		php spark db:seed Distribuidores

		- llamar a otro seeder
		$this->call("otroSedder");

		- roll back
		
		*/
		$faker = \Faker\Factory::create('es_ES');
		for ($i = 0; $i <= 50; $i++) {
			for ($i = 0; $i <= 13; $i++) {
				$ruc = $faker->numberBetween(100000,90000000000);
			}
			$data[] = [
				'dis_text_nombrecomercio' => $faker->name,
				'com_text_ruc' => $ruc,
				'dis_text_direccion' => $faker->address,
				'dis_text_telefono1' => $faker->phoneNumber,
				'dis_text_ciudad' => $faker->state,
				'dis_text_telefono2' => $faker->phoneNumber,
				'com_text_email' => $faker->safeEmail,
			];
		}
		$this->db->table('chauchera.distribuidores')->insertBatch($data);
	}
}
