<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

require_once APPPATH . 'ThirdParty/faker/src/autoload.php';

class Productos extends Seeder {

	public function run() {
		/*
		- Para crear el seeder
		php spark make:seeder
		 
		- en linea de comando correr 
		php spark db:seed Productos

		- llamar a otro seeder
		$this->call("otroSedder");

		- roll back
		
		*/
		$faker = \Faker\Factory::create('es_ES');
		for ($i = 0; $i <= 1; $i++) {
			$data[] = [
				'pro_text_nombre' => $faker->sentence,
			];
		}
		$this->db->table('chauchera.productos')->insertBatch($data);
	}
}
