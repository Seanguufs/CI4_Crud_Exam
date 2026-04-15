<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<?php $isCore = $role && in_array($role['name'], ['admin','teacher','student','coordinator']); ?>

<div style="display:flex;align-items:flex-end;justify-content:space-between;gap:16px;margin-bottom:28px;flex-wrap:wrap;">
    <div>
        <h2 style="font-size:1.4rem;font-weight:800;color:#1a1916;letter-spacing:-0.02em;margin:0 0 4px;">
            Edit Role &nbsp;<code style="font-size:1rem;">@<?= esc($role['name']) ?></code>
        </h2>
        <p style="font-size:0.875rem;color:#9c9a94;margin:0;">Modify the label and description for this role.</p>
    </div>
    <a href="<?= base_url('/admin/roles') ?>" class="btn-rbac-secondary">
        <i class="bi bi-arrow-left"></i> Back to Roles
    </a>
</div>

<div style="max-width:560px;">
    <div style="background:#fff;border:1px solid #e8e6e0;border-radius:14px;overflow:hidden;box-shadow:0 1px 3px rgba(0,0,0,0.05);">
        <div style="padding:20px 24px;">

            <?php if (session('errors')): ?>
                <div class="rbac-alert error" style="margin-bottom:20px;">
                    <i class="bi bi-exclamation-circle-fill" style="flex-shrink:0;margin-top:1px;"></i>
                    <div>
                        <?php foreach (session('errors') as $err): ?>
                            <div><?= esc($err) ?></div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>

            <form action="<?= base_url('admin/roles/update/' . $role['id']) ?>" method="POST">
                <?= csrf_field() ?>

                <div style="margin-bottom:18px;">
                    <label style="display:block;font-size:0.82rem;font-weight:600;color:#6b6860;margin-bottom:6px;">Slug (name)</label>
                    <div style="display:flex;align-items:center;background:#f5f4f0;border:1.5px solid #e8e6e0;border-radius:10px;overflow:hidden;<?= $isCore ? 'opacity:0.7;' : '' ?>">
                        <span style="padding:0 10px 0 14px;color:#9c9a94;font-family:monospace;font-size:1rem;flex-shrink:0;">@</span>
                        <input type="text" name="name" value="<?= old('name', $role['name']) ?>"
                               <?= $isCore ? 'readonly' : '' ?>
                               style="flex:1;border:none;background:transparent;padding:10px 14px 10px 0;font-size:0.875rem;font-family:monospace;color:#1a1916;outline:none;">
                        <?php if ($isCore): ?>
                            <span style="padding:0 14px;color:#b45309;flex-shrink:0;" title="Core role slug is locked"><i class="bi bi-lock-fill"></i></span>
                        <?php endif; ?>
                    </div>
                    <?php if ($isCore): ?>
                        <div style="font-size:0.75rem;color:#b45309;margin-top:4px;display:flex;align-items:center;gap:4px;"><i class="bi bi-shield-lock"></i> Core role slug is permanently locked.</div>
                    <?php endif; ?>
                </div>

                <div style="margin-bottom:18px;">
                    <label style="display:block;font-size:0.82rem;font-weight:600;color:#6b6860;margin-bottom:6px;">Display Label <span style="color:#c0392b;">*</span></label>
                    <input type="text" name="label" class="rbac-input" value="<?= old('label', $role['label']) ?>" placeholder="e.g. Coordinator">
                </div>

                <div style="margin-bottom:24px;">
                    <label style="display:block;font-size:0.82rem;font-weight:600;color:#6b6860;margin-bottom:6px;">Description</label>
                    <textarea name="description" class="rbac-input" rows="3"><?= old('description', $role['description'] ?? '') ?></textarea>
                </div>

                <div style="display:flex;gap:10px;justify-content:flex-end;">
                    <a href="<?= base_url('admin/roles') ?>" class="btn-rbac-secondary">Cancel</a>
                    <button type="submit" class="clean-btn-primary">
                        <i class="bi bi-check-lg"></i> Update Role
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
