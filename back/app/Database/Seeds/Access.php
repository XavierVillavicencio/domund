<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

require_once APPPATH . 'ThirdParty/faker/src/autoload.php';

class Access extends Seeder
{
	public function run()
	{
		/*
		- Para crear el seeder
		php spark make:seeder
		 
		- en linea de comando correr 
		php spark db:seed Users
		*/

		$faker = \Faker\Factory::create();
		for ($i = 0; $i <= 50; $i++) {
			$data[] = [
				'acc_text_description' => $faker->sentence,
				'acc_text_tag' => $faker->text("5")."_$i",
			];
		}
		$this->db->table('administration.access')->insertBatch($data);
	}
}



