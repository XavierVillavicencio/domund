<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

require_once APPPATH . 'ThirdParty/faker/src/autoload.php';

class Issues extends Seeder
{
	public function run()
	{
		$faker = \Faker\Factory::create('es_ES');
		for ($i = 0; $i <= 100; $i++) {
			$data[] = [
				'isu_int_pid' => 30,
				'use_int_id' => $faker->numberBetween(1,1),
				'isu_text_description' => $faker->sentence,
				'top_int_id' => $faker->numberBetween(1,6),								
				'cus_int_id' => $faker->numberBetween(1,6),								
			];
		}
		$this->db->table('administration.issues')->insertBatch($data);
	}
}
