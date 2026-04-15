<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class FixExamRecordsTable extends Migration
{
    public function up()
    {
        if ($this->db->fieldExists('exam_duration', 'exam_records')) {
            $this->forge->dropColumn('exam_records', ['exam_duration', 'exam_items']);
        }
        
        if (!$this->db->fieldExists('status', 'exam_records')) {
            $this->forge->addColumn('exam_records', [
                'status' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 50,
                    'after'      => 'category'
                ],
            ]);
        }
        if (!$this->db->fieldExists('exam_time', 'exam_records')) {
            $this->forge->addColumn('exam_records', [
                'exam_time' => [
                    'type' => 'TIME',
                    'null' => true,
                    'after' => 'exam_date'
                ]
            ]);
        }
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
