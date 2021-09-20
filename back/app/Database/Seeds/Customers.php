<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

require_once APPPATH . 'ThirdParty/faker/src/autoload.php';

class Customers extends Seeder {

	public function run() {
		/*
		- Para crear el seeder
		php spark make:seeder
		 
		- en linea de comando correr 
		php spark db:seed Users

		- llamar a otro seeder
		$this->call("otroSedder");

		- roll back
		
		*/
		$faker = \Faker\Factory::create('es_ES');
		for ($i = 0; $i <= 5; $i++) {
			$data[] = [
				'cus_text_name' => $faker->name,
				'cus_text_lastname' => $faker->lastName,
				'cus_text_phone' => $faker->phoneNumber,
				'cus_text_email' => $faker->safeEmail,
				'cus_text_address' => $faker->address,
				'use_int_id' => $faker->numberBetween(1,5),
			];
		}
		$this->db->table('administration.customers')->insertBatch($data);
	}
}
