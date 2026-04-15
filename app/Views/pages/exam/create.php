<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h4>Create Exam Record</h4>

<?php if(session()->getFlashdata('exam_error')): ?>
  <div class="alert alert-danger"><?= session()->getFlashdata('exam_error') ?></div>
<?php endif; ?>

<form action="<?= base_url('exam/store') ?>" method="post">
  <?= csrf_field() ?>

  <div class="mb-3">
    <label class="form-label">Title</label>
    <input name="title" class="form-control" value="<?= old('title') ?>">
    <?php if(isset($validation) && $validation->getError('title')): ?>
      <small class="text-danger"><?= $validation->getError('title') ?></small>
    <?php endif; ?>
  </div>

  <div class="mb-3">
    <label class="form-label">Description</label>
    <textarea name="description" class="form-control" rows="4"><?= old('description') ?></textarea>
    <?php if(isset($validation) && $validation->getError('description')): ?>
      <small class="text-danger"><?= $validation->getError('description') ?></small>
    <?php endif; ?>
  </div>

  <div class="mb-3">
    <label class="form-label">Category</label>
    <input name="category" class="form-control" value="<?= old('category') ?>">
    <?php if(isset($validation) && $validation->getError('category')): ?>
      <small class="text-danger"><?= $validation->getError('category') ?></small>
    <?php endif; ?>
  </div>

  <div class="mb-3">
    <label class="form-label">Status</label>
    <select name="status" class="form-control">
      <option value="active" <?= old('status')=='active' ? 'selected' : '' ?>>Active</option>
      <option value="inactive" <?= old('status')=='inactive' ? 'selected' : '' ?>>Inactive</option>
    </select>
    <?php if(isset($validation) && $validation->getError('status')): ?>
      <small class="text-danger"><?= $validation->getError('status') ?></small>
    <?php endif; ?>
  </div>

  <div class="mb-3">
    <label class="form-label">Exam Date</label>
    <input type="date" name="exam_date" class="form-control" value="<?= old('exam_date') ?>">
  </div>

  <div class="mb-3">
    <label class="form-label">Exam Time</label>
    <input type="time" name="exam_time" class="form-control" value="<?= old('exam_time') ?>">
  </div>

  <button class="btn btn-primary">Save</button>
  <a href="<?= base_url('exam') ?>" class="btn btn-secondary">Cancel</a>
</form>

<?= $this->endSection() ?>