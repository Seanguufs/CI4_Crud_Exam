<?= $this->extend('layouts/main'); ?>
<?= $this->section('content'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12 mb-3">
            <h2 class="m-0">Edit Student</h2>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Update Student Information</h3>
                </div>
                <div class="card-body">
                    <form action="/student/update/<?= $student['id'] ?>" method="post">
                        <?= csrf_field() ?>
                        <div class="mb-3">
                            <label>Full Name</label>
                            <input type="text" name="name" class="form-control" value="<?= esc($student['name']) ?>" required>
                        </div>
                        <div class="mb-3">
                            <label>Email Address</label>
                            <input type="email" name="email" class="form-control" value="<?= esc($student['email']) ?>" required>
                        </div>
                        <div class="mb-3">
                            <label>Course</label>
                            <input type="text" name="course" class="form-control" value="<?= esc($student['course']) ?>" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="/student/view/<?= $student['id'] ?>" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>
