<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

require_once APPPATH . 'ThirdParty/faker/src/autoload.php';

class Pro_presentacion extends Seeder {

	public function run() {
		/*
		- Para crear el seeder
		php spark make:seeder
		 
		- en linea de comando correr 
		php spark db:seed Pro_presentacion

		- llamar a otro seeder
		$this->call("otroSedder");

		- roll back
		
		*/
		$faker = \Faker\Factory::create('es_ES');
		for ($i = 0; $i <= 50; $i++) {
			
			$data[] = [
				'pre_nombre' => $faker->name,
				'pre_comercio' => $faker->numberBetween(1,20),
				'pre_publico' => $faker->numberBetween(1,20),
				'pro_int_id' => $faker->numberBetween(1,50),
			];
		}
		$this->db->table('chauchera.pro_presentacion')->insertBatch($data);
	}
}
