<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

require_once APPPATH . 'ThirdParty/faker/src/autoload.php';

class Facturacion extends Seeder {

	public function run() {
		/*
		- Para crear el seeder
		php spark make:seeder
		 
		- en linea de comando correr 
		php spark db:seed Facturacion

		- llamar a otro seeder
		$this->call("otroSedder");

		- roll back
		
		*/
		$faker = \Faker\Factory::create('es_ES');
		for ($i = 0; $i <= 1; $i++) {
			
			$data[] = [
				'fac_date_fechaventa' => $faker->dateTimeBetween('now', '+15 days')->format('Y-m-d'),
				'fac_decimal_montorecarga' => $faker->numberBetween(1.2,50.50),
				'fac_text_beneficiario' => $faker->text,
				'pro_int_id' => $faker->numberBetween(1,50),
				'dis_int_id' => $faker->numberBetween(1,50),
				
			];
		}
		$this->db->table('chauchera.facturacion')->insertBatch($data);
	}
}
