<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddDateTimeToExamRecords extends Migration
{
    public function up()
    {
        $this->forge->addColumn('exam_records', [
            'exam_date' => [
                'type' => 'DATE',
                'null' => true,
                'after' => 'status'
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
        $this->forge->dropColumn('exam_records', ['exam_date', 'exam_time']);
    }
}
