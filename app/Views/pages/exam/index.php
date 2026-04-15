<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-3">
  <div>
    <h4 class="mb-0">Exam Records</h4>
    <small class="text-muted">Logged in as: <?= esc(session()->get('username')) ?></small>
  </div>
  <div>
    <a href="<?= base_url('exam/create') ?>" class="btn btn-primary">Add New</a>
  </div>
</div>

<div class="card">
  <div class="card-body">
    <?php if (empty($records)): ?>
      <p class="text-muted">No records yet.</p>
    <?php else: ?>
      <table class="table table-striped">
        <thead><tr>
          <th>#</th><th>Title</th><th>Category</th><th>Status</th><th>Date</th><th>Time</th><th>Actions</th>
        </tr></thead>
        <tbody>
          <?php $no = 1; foreach ($records as $r): ?>
          <tr>
            <td><?= $no++ ?></td>
            <td><a href="<?= base_url('exam/show/'.$r['id']) ?>"><?= esc($r['title']) ?></a></td>
            <td><?= esc($r['category']) ?></td>
            <td><?= esc($r['status']) ?></td>
            <td><?= esc($r['exam_date'] ?? '-') ?></td>
            <td><?= esc($r['exam_time'] ?? '-') ?></td>
            <td>
              <a href="<?= base_url('exam/edit/'.$r['id']) ?>" class="btn btn-sm btn-warning">Edit</a>
              <a href="<?= base_url('exam/delete/'.$r['id']) ?>" class="btn btn-sm btn-danger"
                 onclick="return confirm('Delete this record?')">Delete</a>
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    <?php endif; ?>
  </div>
</div>

<?= $this->endSection() ?>