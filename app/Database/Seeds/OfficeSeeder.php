<?php

namespace App\Database\Seeds;

use Faker\Factory;
use CodeIgniter\Database\Seeder;

class OfficeSeeder extends Seeder
{
    public function run()
    {
        $fakerObject = Factory::create();
 
        for ($i = 0; $i < 10; $i++) {
            $officename = strtoupper($fakerObject->company);
            $data = [
                'code' => substr($officename, 0,3),
                'name' => $officename,
                'created_at' =>  date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ];
 
            $this->db->table('offices')->insert($data);
        }
    }
}
