<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>RBAC System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('assets/css/premium.css') ?>?v=<?= time() ?>" />
</head>
<body>
    <div class="layout-wrapper">
        <?= $this->include('layouts/sidebar') ?>
        <div class="main-wrapper" style="flex:1;min-width:0;">
            <main class="content-wrapper">
                <?php if (session()->getFlashdata('success')): ?>
                    <div class="rbac-alert success mb-4">
                        <i class="bi bi-check-circle-fill" style="flex-shrink:0;margin-top:1px;"></i>
                        <span><?= session()->getFlashdata('success') ?></span>
                    </div>
                <?php endif; ?>
                <?php if (session()->getFlashdata('error')): ?>
                    <div class="rbac-alert error mb-4">
                        <i class="bi bi-exclamation-circle-fill" style="flex-shrink:0;margin-top:1px;"></i>
                        <span><?= session()->getFlashdata('error') ?></span>
                    </div>
                <?php endif; ?>
                <?= $this->renderSection('content') ?>
            </main>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
    <?= $this->renderSection('javascript') ?>
</body>
</html>
