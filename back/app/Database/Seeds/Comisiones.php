<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

require_once APPPATH . 'ThirdParty/faker/src/autoload.php';

class Comisiones extends Seeder {

	public function run() {
		/*
		- Para crear el seeder
		php spark make:seeder
		 
		- en linea de comando correr 
		php spark db:seed Comisiones

		- llamar a otro seeder
		$this->call("otroSedder");

		- roll back
		
		*/
		$faker = \Faker\Factory::create('es_ES');
		for ($i = 0; $i <= 50; $i++) {
			
			$data[] = [
				'com_operacion' => $faker->numberBetween(1,20),
				'com_saldo' => $faker->numberBetween(1,20),
				'dis_int_id' => $faker->numberBetween(1,50),
				
			];
		}
		$this->db->table('chauchera.comisiones')->insertBatch($data);
	}
}
