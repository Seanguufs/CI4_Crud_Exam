<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateExamRecordsTable extends Migration
{

   public function up()
{
    $this->forge->addField([
        'id' => [
            'type'           => 'INT',
            'constraint'     => 11,
            'unsigned'       => true,
            'auto_increment' => true,
        ],
        'title' => [
            'type'       => 'VARCHAR',
            'constraint' => 255,
        ],
        'description' => [
            'type' => 'TEXT',
        ],
        'category' => [
            'type'       => 'VARCHAR',
            'constraint' => 150,
        ],
        'status' => [
            'type'       => 'VARCHAR',
            'constraint' => 50,
        ],
        'created_by' => [
            'type'       => 'VARCHAR',
            'constraint' => 100,
            'null'       => true,
        ],
        'created_at' => [
            'type' => 'DATETIME',
            'null' => true,
        ],
        'updated_at' => [
            'type' => 'DATETIME',
            'null' => true,
        ],
    ]);

    $this->forge->addKey('id', true);
    $this->forge->createTable('exam_records');
}

    public function down()
{
    $this->forge->dropTable('exam_records');
}
}
