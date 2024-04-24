<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TicketMigration extends Migration
{
    public function up()
    {
        $field = [
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
                'null' => false,
            ],
            'first_name' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false,
            ],
            'last_name' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false,
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false,
            ],
            'office_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => false,
            ],
            'state' => [
                'type' => 'ENUM',
                'constraint' => ['open', 'closed'],
                'default' => 'open',
            ],
            'severity' => [
                'type' => 'ENUM',
                'constraint' => ['low', 'medium', 'high'],
                'default' => 'low',
            ],
            'description' => [
                'type' => 'TEXT',
                'null' => false,
            ],
            'remarks' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => false,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => false,
            ],
        ];
 
        $this->forge->addField($field);
        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('office_id', 'offices', 'id');
        $this->forge->createTable('tickets');
 
    }
 
    public function down()
    {
        $this->forge->dropTable('tickets');
    }
}
