<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="card">
  <div class="card-header d-flex justify-content-between">
    <h5>Record Details</h5>
    <div>
      <a href="<?= base_url('exam/edit/' . $record['id']) ?>" class="btn btn-sm btn-warning">Edit</a>
      <a href="<?= base_url('exam/delete/' . $record['id']) ?>" class="btn btn-sm btn-danger"
         onclick="return confirm('Delete this record?')">Delete</a>
    </div>
  </div>

  <div class="card-body">
    <dl class="row">
      <dt class="col-sm-3">Title</dt>
      <dd class="col-sm-9"><?= esc($record['title']) ?></dd>

      <dt class="col-sm-3">Description</dt>
      <dd class="col-sm-9"><?= nl2br(esc($record['description'])) ?></dd>

      <dt class="col-sm-3">Category</dt>
      <dd class="col-sm-9"><?= esc($record['category']) ?></dd>

      <dt class="col-sm-3">Status</dt>
      <dd class="col-sm-9"><?= esc($record['status']) ?></dd>

      <dt class="col-sm-3">Created At</dt>
      <dd class="col-sm-9"><?= esc($record['created_at']) ?></dd>
    </dl>
  </div>
</div>

<?= $this->endSection() ?>