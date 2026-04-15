<?= $this->extend('layouts/main'); ?>
<?= $this->section('content'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12 mb-3">
            <h2 class="m-0">Student Management System</h2>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
<<<<<<< HEAD
                    <h3 class="card-title"><?= isset($student) ? 'Edit Student' : 'Add New Student' ?></h3>
                </div>
                <div class="card-body">
                    <form action="<?= isset($student) ? '/student/update/' . $student['id'] : '/student/store' ?>" method="post">
                        <?= csrf_field() ?>
                        <div class="mb-3">
                            <label class="form-label">Full Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Full Name" value="<?= isset($student) ? esc($student['name']) : '' ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email Address</label>
                            <input type="email" name="email" class="form-control" placeholder="Email Address" value="<?= isset($student) ? esc($student['email']) : '' ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Course</label>
                            <input type="text" name="course" class="form-control" placeholder="Course (e.g., BSIT)" value="<?= isset($student) ? esc($student['course']) : '' ?>" required>
                        </div>
                        <button type="submit" class="btn btn-primary"><?= isset($student) ? 'Update Student' : 'Add Student' ?></button>
                        <?php if(isset($student)): ?>
                            <a href="/students" class="btn btn-secondary">Cancel</a>
                        <?php endif; ?>
=======
                    <h3 class="card-title">Add New Student</h3>
                </div>
                <div class="card-body">
                    <form action="/student/store" method="post">
                        <?= csrf_field() ?>
                        <div class="mb-3">
                            <input type="text" name="name" class="form-control" placeholder="Full Name" required>
                        </div>
                        <div class="mb-3">
                            <input type="email" name="email" class="form-control" placeholder="Email Address" required>
                        </div>
                        <div class="mb-3">
                            <input type="text" name="course" class="form-control" placeholder="Course (e.g., BSIT)" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Add Student</button>
>>>>>>> 9ba83627075c63629f030a4305e2abafb941156b
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Students</h3>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Course</th>
<<<<<<< HEAD
=======
                                <th>Date Added</th>
>>>>>>> 9ba83627075c63629f030a4305e2abafb941156b
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(!empty($students)): foreach($students as $s): ?>
                            <tr>
<<<<<<< HEAD
                                <td><a href="/student/show/<?= $s['id'] ?>"><?= esc($s['name']) ?></a></td>
                                <td><?= esc($s['email']) ?></td>
                                <td><?= esc($s['course']) ?></td>
                                <td>
                                    <a href="/student/edit/<?= $s['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                                    <form action="/student/delete/<?= $s['id'] ?>" method="post" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this student?')">
                                        <?= csrf_field() ?>
                                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
=======
                                <td><?= esc($s['name']) ?></td>
                                <td><?= esc($s['email']) ?></td>
                                <td><?= esc($s['course']) ?></td>
                                <td><?= date('F j, Y', strtotime($s['created_at'])) ?></td>
                                <td>
                                    <a href="/student/view/<?= $s['id'] ?>" class="btn btn-sm btn-info">View</a>
                                    <form action="/student/delete/<?= $s['id'] ?>" method="post" class="d-inline" onsubmit="return confirm('Are you sure?')">
                                        <?= csrf_field() ?>
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn btn-sm btn-danger btn-hover">Delete</button>
>>>>>>> 9ba83627075c63629f030a4305e2abafb941156b
                                    </form>
                                </td>
                            </tr>
                            <?php endforeach; else: ?>
                            <tr>
<<<<<<< HEAD
                                <td colspan="4" class="text-center">No students found.</td>
=======
                                <td colspan="5" class="text-center">No students found.</td>
>>>>>>> 9ba83627075c63629f030a4305e2abafb941156b
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
<<<<<<< HEAD
                <?php if(!empty($students)): ?>
                <div class="card-footer clearfix">
                    <?= $pager->links() ?>
                </div>
                <?php endif; ?>
=======
>>>>>>> 9ba83627075c63629f030a4305e2abafb941156b
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>
