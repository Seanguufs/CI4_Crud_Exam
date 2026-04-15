<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table      = 'users';
    protected $primaryKey = 'id';

    protected $useTimestamps  = true;
    protected $useSoftDeletes = false;
    protected $createdField   = 'created_at';
    protected $updatedField   = 'updated_at';

    protected $allowedFields = [
        'fullname', 'username', 'password', 'role', 'role_id',
        'student_id', 'course', 'year_level',
        'section', 'phone', 'address', 'profile_image',
    ];

    protected $returnType = 'array';

    public function findByEmail(string $email): ?array
    {
        return $this->where('username', $email)->first();
    }

    public function findWithRole(int $id): ?array
    {
        return $this->db->table('users u')
            ->select('u.*, r.name AS role_name, r.label AS role_label')
            ->join('roles r', 'r.id = u.role_id', 'left')
            ->where('u.id', $id)
            ->get()->getRowArray();
    }

    public function getAllWithRoles(): array
    {
        return $this->db->table('users u')
            ->select('u.id, u.fullname AS name, u.username AS email,
                      u.role_id, u.created_at,
                      r.name AS role_name, r.label AS role_label')
            ->join('roles r', 'r.id = u.role_id', 'left')
            ->orderBy('u.fullname', 'ASC')
            ->get()->getResultArray();
    }

    public function updateProfile(int $userId, array $data): bool
    {
        return $this->update($userId, $data);
    }
}
