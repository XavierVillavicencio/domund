<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

require_once APPPATH . 'ThirdParty/faker/src/autoload.php';

class Business extends Seeder
{
	public function run()
	{   
		$faker = \Faker\Factory::create('es_ES');
		for ($i = 0; $i <= 5; $i++) {
			$data[] = [
				'bus_text_name' => $faker->Company,
				'bus_text_identification' => $faker->numberBetween(100000,90000000000),
				'bus_text_address' => $faker->address,
				'bus_text_phone' => $faker->phoneNumber,
				'bus_text_email' => $faker->safeEmail,
			];
		}
		$this->db->table('administration.business')->insertBatch($data);

	}
}
