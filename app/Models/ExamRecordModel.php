<?php
namespace App\Models;

use CodeIgniter\Model;

class ExamRecordModel extends Model
{
    protected $table      = 'exam_records';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'title',
        'description',
        'category',
        'status',
        'exam_date',
        'exam_time',
        'created_by'
    ];

    // timestamps
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}