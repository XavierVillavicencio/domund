<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

require_once APPPATH . 'ThirdParty/faker/src/autoload.php';

class Users extends Seeder {

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
		$faker = \Faker\Factory::create('fr_FR');
		for ($i = 0; $i <= 10; $i++) {
			$data[] = [
				'use_text_user' => $faker->safeEmail,
				'use_text_pass' => $faker->password,
				'use_text_name' => $faker->name,
				'use_text_lastname' => $faker->lastName,
				'use_text_phone' => $faker->phoneNumber,
				'use_int_admin' => $faker->randomElement($array = array(1, 0)),
				'use_text_address' => $faker->address,
			];
		}
		$this->db->table('administration.users')->insertBatch($data);
	}
}
