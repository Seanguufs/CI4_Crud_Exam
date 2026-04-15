<?php
namespace App\Controllers;

use App\Models\ExamRecordModel;

class Exam extends BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new ExamRecordModel();
    }

    public function index()
    {
        $this->data['records'] = $this->model->orderBy('id', 'DESC')->findAll();
        $this->data['pager'] = $this->model->pager ?? null;

        return view('pages/exam/index', $this->data);
    }

    public function create()
    {
        return view('pages/exam/create', $this->data);
    }

    public function store()
    {
        $rules = [
            'title' => 'required|min_length[3]',
            'description' => 'required|min_length[10]',
            'category' => 'required',
            'status' => 'required'
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('exam_error', 'Please fix the errors below')
                ->with('validation', $this->validator);
        }

        $data = [
            'title' => $this->request->getPost('title'),
            'description' => $this->request->getPost('description'),
            'category' => $this->request->getPost('category'),
            'status' => $this->request->getPost('status'),
            'exam_date' => $this->request->getPost('exam_date'),
            'exam_time' => $this->request->getPost('exam_time'),
            'created_by' => session()->get('username')
        ];

        if (!$this->model->save($data)) {
            return redirect()->back()
                ->withInput()
                ->with('exam_error', 'Failed to save record: ' . implode(', ', $this->model->errors()));
        }

        return redirect()->to(base_url('exam'))->with('exam_success', 'Record created successfully');
    }

    public function show($id = null)
    {
        $record = $this->model->find($id);
        if (! $record) {
            return redirect()->to(base_url('exam'))->with('exam_error','Record not found');
        }

        $this->data['record'] = $record;
        return view('pages/exam/show', $this->data);
    }

    public function edit($id = null)
    {
        $record = $this->model->find($id);
        if (! $record) {
            return redirect()->to(base_url('exam'))->with('exam_error','Record not found');
        }

        $this->data['record'] = $record;
        return view('pages/exam/edit', $this->data);
    }

    public function update($id = null)
    {
        $rules = [
            'title' => 'required|min_length[3]',
            'description' => 'required|min_length[10]',
            'category' => 'required',
            'status' => 'required'
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('exam_error', 'Please fix the errors below')
                ->with('validation', $this->validator);
        }

        $this->model->update($id, [
            'title' => $this->request->getPost('title'),
            'description' => $this->request->getPost('description'),
            'category' => $this->request->getPost('category'),
            'status' => $this->request->getPost('status'),
            'exam_date' => $this->request->getPost('exam_date'),
            'exam_time' => $this->request->getPost('exam_time'),
        ]);

        return redirect()->to(base_url('exam'))->with('exam_success', 'Record updated successfully');
    }

    public function delete($id = null)
    {
        if (! $this->model->find($id)) {
            return redirect()->to(base_url('exam'))->with('exam_error','Record not found');
        }

        $this->model->delete($id);
        return redirect()->to(base_url('exam'))->with('exam_success', 'Record deleted');
    }
}