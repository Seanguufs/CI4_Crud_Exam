<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div style="display:flex;align-items:flex-end;justify-content:space-between;gap:16px;margin-bottom:28px;flex-wrap:wrap;">
    <div>
        <h2 style="font-size:1.4rem;font-weight:800;color:#1a1916;letter-spacing:-0.02em;margin:0 0 4px;">Role Management</h2>
        <p style="font-size:0.875rem;color:#9c9a94;margin:0;">Configure what modules your users can access.</p>
    </div>
    <a href="<?= base_url('/admin/roles/create') ?>" class="clean-btn-primary">
        <i class="bi bi-plus-circle"></i> Create New Role
    </a>
</div>

<div style="background:#eef4fc;border:1px solid #bdd5f0;border-radius:12px;padding:14px 18px;display:flex;align-items:flex-start;gap:12px;margin-bottom:24px;">
    <i class="bi bi-shield-lock-fill" style="color:#2563a8;font-size:1.1rem;flex-shrink:0;margin-top:1px;"></i>
    <div style="font-size:0.875rem;color:#2563a8;line-height:1.6;">
        <strong>Administrator Access Only</strong> — The <code>admin</code> core role cannot be deleted. Removing a role automatically unassigns all bound users.
    </div>
</div>

<div style="background:#fff;border:1px solid #e8e6e0;border-radius:14px;overflow:hidden;box-shadow:0 1px 3px rgba(0,0,0,0.05);">
    <div class="table-responsive">
        <table class="rbac-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Role Identifier</th>
                    <th>Label</th>
                    <th>Description</th>
                    <th style="text-align:center;">Users</th>
                    <th style="text-align:center;">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($roles as $i => $role): ?>
                <tr>
                    <td style="font-family:monospace;color:#9c9a94;"><?= sprintf('%02d', $i + 1) ?></td>
                    <td>
                        <code>@<?= esc($role['name']) ?></code>
                        <?php if ($role['name'] === 'admin'): ?>
                            <i class="bi bi-shield-fill-check ms-1" style="color:#2563a8;font-size:0.8rem;" title="System Protected"></i>
                        <?php endif; ?>
                    </td>
                    <td style="font-weight:600;color:#1a1916;"><?= esc($role['label']) ?></td>
                    <td style="max-width:280px;"><?= esc($role['description'] ?? '—') ?></td>
                    <td style="text-align:center;">
                        <span style="background:#f5f4f0;color:#6b6860;padding:3px 10px;border-radius:20px;font-size:0.75rem;font-weight:700;"><?= $role['user_count'] ?></span>
                    </td>
                    <td style="text-align:center;">
                        <div style="display:flex;align-items:center;justify-content:center;gap:6px;">
                            <a href="<?= base_url('/admin/roles/edit/' . $role['id']) ?>"
                               style="width:30px;height:30px;border-radius:7px;background:#f5f4f0;color:#6b6860;border:1px solid #e8e6e0;display:inline-flex;align-items:center;justify-content:center;text-decoration:none;transition:all 0.15s;"
                               onmouseover="this.style.background='#e8e6e0';this.style.color='#1a1916'"
                               onmouseout="this.style.background='#f5f4f0';this.style.color='#6b6860'"
                               title="Edit">
                                <i class="bi bi-pencil-fill" style="font-size:0.75rem;"></i>
                            </a>
                            <?php if ($role['name'] !== 'admin'): ?>
                            <button type="button"
                                    style="width:30px;height:30px;border-radius:7px;background:#fdf2f1;color:#c0392b;border:1px solid #f5c6c2;display:inline-flex;align-items:center;justify-content:center;cursor:pointer;transition:all 0.15s;"
                                    onmouseover="this.style.background='#c0392b';this.style.color='#fff'"
                                    onmouseout="this.style.background='#fdf2f1';this.style.color='#c0392b'"
                                    data-bs-toggle="modal" data-bs-target="#deleteModal"
                                    data-id="<?= $role['id'] ?>"
                                    data-label="<?= esc($role['label']) ?>"
                                    data-count="<?= $role['user_count'] ?>" title="Delete">
                                <i class="bi bi-trash3-fill" style="font-size:0.75rem;"></i>
                            </button>
                            <?php else: ?>
                            <button disabled style="width:30px;height:30px;border-radius:7px;background:transparent;color:#d4d0c8;border:1px solid #e8e6e0;display:inline-flex;align-items:center;justify-content:center;cursor:not-allowed;" title="System Core Locked">
                                <i class="bi bi-lock-fill" style="font-size:0.75rem;"></i>
                            </button>
                            <?php endif; ?>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="bi bi-exclamation-triangle-fill me-2" style="color:#c0392b;"></i>Delete Role</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p style="font-size:0.9rem;color:#6b6860;margin-bottom:12px;">Are you sure you want to delete the <strong id="deleteRoleLabel" style="color:#1a1916;font-family:monospace;"></strong> role?</p>
                <div id="deleteWarning" style="display:none;background:#fef9ee;border:1px solid #f5d9a0;border-radius:10px;padding:12px 14px;font-size:0.85rem;color:#b45309;gap:8px;align-items:flex-start;">
                    <i class="bi bi-people-fill" style="flex-shrink:0;margin-top:1px;"></i>
                    <span id="deleteWarningText"></span>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-rbac-secondary" data-bs-dismiss="modal">Cancel</button>
                <a href="#" id="deleteConfirmBtn" class="clean-btn-primary" style="background:#c0392b;">
                    <i class="bi bi-trash3"></i> Delete Role
                </a>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
<?= $this->section('javascript') ?>
<script>
document.getElementById('deleteModal').addEventListener('show.bs.modal', function (e) {
    const btn   = e.relatedTarget;
    const count = parseInt(btn.dataset.count);
    document.getElementById('deleteRoleLabel').textContent = '@' + btn.dataset.label;
    document.getElementById('deleteConfirmBtn').href = '<?= base_url('/admin/roles/delete/') ?>' + btn.dataset.id;
    const warn = document.getElementById('deleteWarning');
    if (count > 0) {
        warn.style.display = 'flex';
        document.getElementById('deleteWarningText').textContent =
            count + ' user(s) are currently assigned this role and will lose access upon deletion.';
    } else {
        warn.style.display = 'none';
    }
});
</script>
<?= $this->endSection() ?>
