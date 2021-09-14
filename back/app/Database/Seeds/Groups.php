<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

require_once APPPATH . 'ThirdParty/faker/src/autoload.php';

class Groups extends Seeder
{
	public function run()
	{
		$faker = \Faker\Factory::create();
		for ($i = 0; $i <= 1000; $i++) {
			$data[] = [
				'gro_text_description' => $faker->sentence,				
			];
		}
		$this->db->table('administration.groups')->insertBatch($data);
	}
}
