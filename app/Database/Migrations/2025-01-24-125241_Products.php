<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Products extends Migration
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
            'name'          => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'code'          => [
                'type'       => 'CHAR',
                'constraint' => 10,
            ],
            'category_id'   => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'unit_id'       => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'capital_price' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'sell_price'    => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'stock'         => [
                'type'       => 'INT',
                'constraint' => 11,
            ],

            'image'          => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'default'        => null,
            ],
            'created_at'    => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at'    => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('category_id', 'categories', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('unit_id', 'units', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('products');
    }

    public function down()
    {
        $this->forge->dropTable('products');
    }
}
