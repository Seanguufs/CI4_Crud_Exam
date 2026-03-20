<?php

namespace App\Controllers;

use App\Models\StudentModel;

class Student extends BaseController
{
    public function index()
    {
        $model = new StudentModel();
        $data = array_merge($this->data, [
<<<<<<< HEAD
            'students' => $model->paginate(10),
            'pager' => $model->pager
=======
            'students' => $model->findAll()
>>>>>>> 9ba83627075c63629f030a4305e2abafb941156b
        ]);
        return view('pages/student_view', $data);
    }

<<<<<<< HEAD
    public function show($id)
    {
        $model = new StudentModel();
        $student = $model->find($id);
        
        if (!$student) {
            session()->setFlashdata('notif_error', 'Student not found');
            return redirect()->to('/students');
        }
        
        $data = array_merge($this->data, [
            'student' => $student
        ]);
        return view('pages/student_show', $data);
    }

    public function store()
    {
        $model = new StudentModel();
        $data = [
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'course' => $this->request->getPost('course'),
        ];
        
        if ($model->insert($data)) {
            session()->setFlashdata('notif_success', 'Student added successfully');
        } else {
            session()->setFlashdata('notif_error', implode('<br>', $model->errors()));
        }
        return redirect()->to('/students');
=======
    public function view($id)
    {
        $model = new StudentModel();
        $student = $model->find($id);
        if (!$student) {
            return redirect()->to('/students');
        }
        $data = array_merge($this->data, [
            'student' => $student
        ]);
        return view('pages/student_detail', $data);
>>>>>>> 9ba83627075c63629f030a4305e2abafb941156b
    }

    public function edit($id)
    {
        $model = new StudentModel();
        $student = $model->find($id);
<<<<<<< HEAD
        
        if (!$student) {
            session()->setFlashdata('notif_error', 'Student not found');
            return redirect()->to('/students');
        }
        
        $data = array_merge($this->data, [
            'student' => $student,
            'students' => $model->paginate(10),
            'pager' => $model->pager
        ]);
        return view('pages/student_view', $data);
=======
        if (!$student) {
            return redirect()->to('/students');
        }
        $data = array_merge($this->data, [
            'student' => $student
        ]);
        return view('pages/student_edit', $data);
>>>>>>> 9ba83627075c63629f030a4305e2abafb941156b
    }

    public function update($id)
    {
        $model = new StudentModel();
        $data = [
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'course' => $this->request->getPost('course'),
        ];
<<<<<<< HEAD
        
        if ($model->update($id, $data)) {
            session()->setFlashdata('notif_success', 'Student updated successfully');
        } else {
            session()->setFlashdata('notif_error', implode('<br>', $model->errors()));
        }
=======
        $model->update($id, $data);
        return redirect()->to('/student/view/' . $id);
    }

    public function store()
    {
        $model = new StudentModel();
        $data = [
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'course' => $this->request->getPost('course'),
        ];
        $model->insert($data);
>>>>>>> 9ba83627075c63629f030a4305e2abafb941156b
        return redirect()->to('/students');
    }

    public function delete($id)
    {
        $model = new StudentModel();
<<<<<<< HEAD
        if ($model->delete($id)) {
            session()->setFlashdata('notif_success', 'Student deleted successfully');
        } else {
            session()->setFlashdata('notif_error', 'Failed to delete student');
        }
=======
        $model->delete($id);
>>>>>>> 9ba83627075c63629f030a4305e2abafb941156b
        return redirect()->to('/students');
    }
}
