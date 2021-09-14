<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

require_once APPPATH . 'ThirdParty/faker/src/autoload.php';

class Follow extends Seeder {

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
		for ($i = 0; $i <= 50; $i++) {
			$data[] = [
				'use_int_id' => $faker->numberBetween(1,1),
				'isu_int_id' => $faker->numberBetween(1308,1330),								
				'fol_date_from' => $faker->dateTimeBetween('now', '+15 days')->format('Y-m-d h:m:s'),
				'fol_date_to' => $faker->dateTimeBetween('+15 days', '+20 days')->format('Y-m-d h:m:s'),
				'fol_text_description' => $faker->sentence,
			];
		}
		$this->db->table('administration.follow')->insertBatch($data);
	}
}
