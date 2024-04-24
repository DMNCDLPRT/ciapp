<?php

namespace App\Database\Seeds;

use Faker\Factory;
use CodeIgniter\Database\Seeder;

class TicketSeeder extends Seeder
{
    public function run()
    {
        $fakerObject = Factory::create();
 
        for ($i = 0; $i < 100; $i++) {
            $data = [
                'first_name' => $fakerObject->firstName,
                'last_name' => $fakerObject->lastName,
                'email' => $fakerObject->email,
                'office_id' => rand(1, 10),
                'state' => $fakerObject->randomElement(['open', 'closed']),
                'severity' => $fakerObject->randomElement(['low', 'medium', 'high']),
                'description' => $fakerObject->text,
                'remarks' => $fakerObject->text,
                'created_at' =>  date('Y-m-d H:i:s'),
                'updated_at' =>  date('Y-m-d H:i:s')
            ];
 
            $this->db->table('tickets')->insert($data);
        }
    }
}
