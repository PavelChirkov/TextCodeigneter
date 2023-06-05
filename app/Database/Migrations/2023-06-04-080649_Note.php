<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Note extends Migration
{
    public function up()
    {
        $this->forge->addField([ 
            'id' => [
                'type' => 'INT',
                'auto_increment' => true
            ],
            'user_id' => [
                'type' => 'INT',
                'default' => '0',
                'null'=>true
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
                'description' => [
                'type' => 'TEXT',
                'constraint' => '600'
            ],
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp',
            'FOREIGN KEY (user_id)  REFERENCES user (id)'
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('note');
    }

    public function down()
    {
        $this->forge->dropTable('note');
    }
}
