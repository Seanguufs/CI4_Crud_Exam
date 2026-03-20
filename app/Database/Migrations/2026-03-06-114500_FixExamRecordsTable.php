<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class FixExamRecordsTable extends Migration
{
    public function up()
    {
        $this->forge->dropColumn('exam_records', ['exam_duration', 'exam_items']);
        
        $this->forge->addColumn('exam_records', [
            'status' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'after'      => 'category'
            ],
            'exam_time' => [
                'type' => 'TIME',
                'null' => true,
                'after' => 'exam_date'
            ]
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('exam_records', ['status', 'exam_time']);
        
        $this->forge->addColumn('exam_records', [
            'exam_duration' => [
                'type'       => 'INT',
                'constraint' => 11,
                'after'      => 'category'
            ],
            'exam_items' => [
                'type'       => 'INT',
                'constraint' => 11,
                'after'      => 'exam_duration'
            ]
        ]);
    }
}
