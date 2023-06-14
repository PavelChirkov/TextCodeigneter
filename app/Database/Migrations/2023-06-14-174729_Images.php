<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Images extends Migration
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
            'note_id' => [
                'type' => 'INT',
                'default' => '0',
                'null'=>true
            ],
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['publish', 'pending', 'draft'],
                'default'    => 'pending',
            ],
            'title' => [
                'type' => 'VARCHAR',
                'constraint' => '100'
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => '100'
            ],
            'visible' => [
                'type'       => 'ENUM',
                'constraint' => ['on', 'off'],
                'default'    => 'on',
            ],
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp',
            'FOREIGN KEY (user_id)  REFERENCES user (id)',
            'FOREIGN KEY (note_id)  REFERENCES note (id)'
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('images');
    }

    public function down()
    {
        $this->forge->dropTable('images');
    }
}
