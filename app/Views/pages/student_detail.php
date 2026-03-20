<?= $this->extend('layouts/main'); ?>
<?= $this->section('content'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12 mb-3">
            <h2 class="m-0">Student Information</h2>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Student Details</h3>
                </div>
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <th width="150">Name:</th>
                            <td><?= esc($student['name']) ?></td>
                        </tr>
                        <tr>
                            <th>Email:</th>
                            <td><?= esc($student['email']) ?></td>
                        </tr>
                        <tr>
                            <th>Course:</th>
                            <td><?= esc($student['course']) ?></td>
                        </tr>
                        <tr>
                            <th>Date Added:</th>
                            <td><?= date('F j, Y', strtotime($student['created_at'])) ?></td>
                        </tr>
                    </table>
                    <a href="/student/edit/<?= $student['id'] ?>" class="btn btn-warning">Edit</a>
                    <a href="/students" class="btn btn-secondary">Back to List</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>
