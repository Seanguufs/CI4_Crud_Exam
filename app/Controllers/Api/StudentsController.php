<?php

namespace App\Controllers\Api;

use App\Models\StudentModel;

/**
 * GET  /api/v1/students        → list all students
 * GET  /api/v1/students/{id}   → single student
 *
 * Requires: Bearer token (teacher or admin role)
 */
class StudentsController extends BaseApiController
{
    private StudentModel $studentModel;

    public function initController(
        \CodeIgniter\HTTP\RequestInterface $request,
        \CodeIgniter\HTTP\ResponseInterface $response,
        \Psr\Log\LoggerInterface $logger
    ): void {
        parent::initController($request, $response, $logger);
        $this->studentModel = new StudentModel();
    }

    public function index()
    {
        if (! $this->hasTeacherAccess()) {
            return $this->forbidden('Only teachers and admins can list students.');
        }

        return $this->ok($this->studentModel->findAll());
    }

    public function show(int $id)
    {
        if (! $this->hasTeacherAccess()) {
            return $this->forbidden('Only teachers and admins can view student profiles.');
        }

        $student = $this->studentModel->find($id);

        if (! $student) {
            return $this->notFound("Student #{$id} not found.");
        }

        return $this->ok($student);
    }

    private function hasTeacherAccess(): bool
    {
        return $this->apiUser && in_array($this->apiUser['role_name'], ['teacher', 'admin'], true);
    }
}
