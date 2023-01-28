<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class User extends Migration
{
    public function up()
    {
            $this->forge->addField([
                'id' => [
                    'type' => 'INT',
                    'auto_increment' => true
                ],
                'login' => [
                    'type' => 'VARCHAR',
                    'constraint' => '255'
                ],
                'password' => [
                    'type' => 'VARCHAR',
                    'constraint' => '255'
                ],
                'description' => [
                    'type' => 'TEXT'
                ],
                'created_at datetime default current_timestamp',
                'updated_at datetime default current_timestamp on update current_timestamp']
        );
            $this->forge->addKey('id', true);
            $this->forge->createTable('user');
    }

    public function down()
    {
        $this->forge->dropTable('user');
    }
}
