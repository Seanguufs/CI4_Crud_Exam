<<<<<<< HEAD
<?php
$alerts = [
    'notif_success' => ['success', 'check-circle-fill'],
    'notif_warning' => ['warning', 'exclamation-triangle-fill'],
    'notif_primary' => ['primary', 'info-circle-fill'],
    'notif_info'    => ['info',    'info-circle-fill'],
    'notif_error'   => ['danger',  'exclamation-triangle-fill'],
];
foreach ($alerts as $key => [$type, $icon]):
    $msg = session()->getFlashdata($key);
    if ($msg):
?>
<div class="alert alert-<?= $type ?> flash-alert alert-dismissible fade show shadow-sm mb-3" role="alert">
    <i class="bi bi-<?= $icon ?> me-2"></i><?= $msg ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php endif; endforeach; ?>
=======
<?php if (session()->getFlashdata('notif_success') || session()->getFlashdata('success')) : ?>
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        <div class="alert-message">
            <?= session()->getFlashdata('notif_success') ?: session()->getFlashdata('success'); ?>
        </div>
    </div>
<?php endif ?>
<?php if (session()->getFlashdata('notif_warning')) : ?>
    <div class="alert alert-warning alert-dismissible" role="alert">
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        <div class="alert-icon">
            <i class="align-middle" data-feather="alert-circle"></i>
        </div>
        <div class="alert-message">
            <?= session()->getFlashdata('notif_warning'); ?>
        </div>
    </div>
<?php endif ?>
<?php if (session()->getFlashdata('notif_primary')) : ?>
    <div class="alert alert-primary alert-dismissible" role="alert">
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        <div class="alert-icon">
            <i class="align-middle" data-feather="alert-circle"></i>
        </div>
        <div class="alert-message">
            <?= session()->getFlashdata('notif_primary'); ?>
        </div>
    </div>
<?php endif ?>
<?php if (session()->getFlashdata('notif_info')) : ?>
    <div class="alert alert-info alert-dismissible" role="alert">
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        <div class="alert-icon">
            <i class="align-middle" data-feather="alert-circle"></i>
        </div>
        <div class="alert-message">
            <?= session()->getFlashdata('notif_info'); ?>
        </div>
    </div>
<?php endif ?>
<?php if (session()->getFlashdata('notif_error')) : ?>
    <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        <div class="alert-message">
            <?= session()->getFlashdata('notif_error') ?: session()->getFlashdata('error'); ?>
        </div>
    </div>
<?php endif ?>
>>>>>>> 9ba83627075c63629f030a4305e2abafb941156b
