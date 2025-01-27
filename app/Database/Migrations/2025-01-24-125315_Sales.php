<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Sales extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'            => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],

            'invoice'       => [
                'type'           => 'VARCHAR',
                'constraint'     => 100,
            ],

            'total'         => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],

            'status'        => [
                'type'           => 'ENUM',
                'constraint'     => ['cash', 'debt'],
                'default'        => 'cash',
            ],

            'created_at'    => [
                'type'           => 'DATETIME',
                'null'           => true,
            ],

            'updated_at'    => [
                'type'           => 'DATETIME',
                'null'           => true,
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('sales');
    }

    public function down()
    {
        $this->forge->dropTable('sales', true);
    }
}
