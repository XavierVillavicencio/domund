<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

require_once APPPATH . 'ThirdParty/faker/src/autoload.php';

class Saldos extends Seeder {

	public function run() {
		/*
		- Para crear el seeder
		php spark make:seeder
		 
		- en linea de comando correr 
		php spark db:seed Saldos

		- llamar a otro seeder
		$this->call("otroSedder");

		- roll back
		
		*/
		$faker = \Faker\Factory::create('es_ES');
		for ($i = 0; $i <= 50; $i++) {
			
			$data[] = [
				'sal_int_operacion' => $faker->numberBetween(1,20),
				'sal_float_valor' => $faker->numberBetween(1,20),
				'sal_float_total' => $faker->numberBetween(1,50),
				'dis_int_id' => $faker->numberBetween(1,50),
				
			];
		}
		$this->db->table('chauchera.saldos')->insertBatch($data);
	}
}
