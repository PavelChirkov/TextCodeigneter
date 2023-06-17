<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Tags extends Migration
{
    public function up()
    {
        $this->forge->addField([ 
            'id' => [
                'type' => 'INT',
                'auto_increment' => true
            ],
            'title' => [
                'type' => 'VARCHAR',
                'constraint' => '100'
            ],
            'parent' => [
                'type' => 'INT',
                'default' => '0',
                'null'=>true
            ],
            'text' => [
                'type' => 'TEXT',           
            ],
            'setting' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'visible' => [
                'type'       => 'ENUM',
                'constraint' => ['on', 'off'],
                'default'    => 'on',
            ],
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp'

        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('tags');
    }

    public function down()
    {
        $this->forge->dropTable('tags');
    }
}
