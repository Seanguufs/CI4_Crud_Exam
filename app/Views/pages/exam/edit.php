<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h4>Edit Record</h4>

<form action="<?= base_url('exam/update/' . $record['id']) ?>" method="post">
  <?= csrf_field() ?>

  <div class="mb-3">
    <label class="form-label">Title</label>
    <input name="title" class="form-control" value="<?= esc(old('title', $record['title'])) ?>">
  </div>

  <div class="mb-3">
    <label class="form-label">Description</label>
    <textarea name="description" class="form-control" rows="4"><?= esc(old('description', $record['description'])) ?></textarea>
  </div>

  <div class="mb-3">
    <label class="form-label">Category</label>
    <input name="category" class="form-control" value="<?= esc(old('category', $record['category'])) ?>">
  </div>

  <div class="mb-3">
    <label class="form-label">Status</label>
    <select name="status" class="form-control">
      <option value="active" <?= old('status', $record['status'])=='active' ? 'selected' : '' ?>>Active</option>
      <option value="inactive" <?= old('status', $record['status'])=='inactive' ? 'selected' : '' ?>>Inactive</option>
    </select>
  </div>

  <div class="mb-3">
    <label class="form-label">Exam Date</label>
    <input type="date" name="exam_date" class="form-control" value="<?= esc(old('exam_date', $record['exam_date'])) ?>">
  </div>

  <div class="mb-3">
    <label class="form-label">Exam Time</label>
    <input type="time" name="exam_time" class="form-control" value="<?= esc(old('exam_time', $record['exam_time'])) ?>">
  </div>

  <button class="btn btn-primary">Update</button>
  <a href="<?= base_url('exam') ?>" class="btn btn-secondary">Cancel</a>
</form>

<?= $this->endSection() ?>