<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

require_once APPPATH . 'ThirdParty/faker/src/autoload.php';

class Topics extends Seeder
{
	public function run()
	{
		$faker = \Faker\Factory::create('es_ES');
		for ($i = 0; $i <= 10; $i++) {
			$data[] = [
				'isu_int_id' => $faker->numberBetween(15,1000),
				'top_text_name' => $faker->sentence,								
			];
		}
		$this->db->table('administration.topics')->insertBatch($data);	
	}
}
