<?php
namespace App\Models;

use CodeIgniter\Model;

class ExamUserModel extends Model
{
    protected $table      = 'exam_users';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'email', 'password'];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = '';
}
