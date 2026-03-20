<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div style="display:flex;align-items:flex-end;justify-content:space-between;gap:16px;margin-bottom:28px;flex-wrap:wrap;">
    <div>
        <h2 style="font-size:1.4rem;font-weight:800;color:#1a1916;letter-spacing:-0.02em;margin:0 0 4px;">User Management</h2>
        <p style="font-size:0.875rem;color:#9c9a94;margin:0;">Assign roles and manage system access for all users.</p>
    </div>
    <a href="<?= base_url('/admin/roles') ?>" class="btn-rbac-secondary">
        <i class="bi bi-shield-lock"></i> Manage Roles
    </a>
</div>

<div style="background:#edf7f1;border:1px solid #b7e4ca;border-radius:12px;padding:14px 18px;display:flex;align-items:flex-start;gap:12px;margin-bottom:24px;">
    <i class="bi bi-info-circle-fill" style="color:#2d7a4f;font-size:1.1rem;flex-shrink:0;margin-top:1px;"></i>
    <div style="font-size:0.875rem;color:#2d7a4f;line-height:1.6;">
        <strong>Role changes take effect on the user's next login.</strong> You cannot change your own role.
    </div>
</div>

<div style="background:#fff;border:1px solid #e8e6e0;border-radius:14px;overflow:hidden;box-shadow:0 1px 3px rgba(0,0,0,0.05);">
    <div style="padding:14px 20px;border-bottom:1px solid #f5f4f0;display:flex;align-items:center;gap:10px;">
        <span style="font-size:0.875rem;font-weight:700;color:#1a1916;">System Users</span>
        <span style="background:#f5f4f0;color:#6b6860;padding:2px 10px;border-radius:20px;font-size:0.72rem;font-weight:700;"><?= count($users) ?></span>
    </div>
    <div class="table-responsive">
        <table class="rbac-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Current Role</th>
                    <th style="text-align:right;padding-right:20px;">Assign Role</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $u):
                    $isSelf = ($u['id'] == (session('user')['id'] ?? 0));
                    $rn = $u['role_name'] ?? '';
                    $badgeStyle = match($rn) {
                        'admin'   => 'background:#fdf2f1;color:#c0392b;border:1px solid #f5c6c2;',
                        'teacher' => 'background:#edf7f1;color:#2d7a4f;border:1px solid #b7e4ca;',
                        'student' => 'background:#eef4fc;color:#2563a8;border:1px solid #bdd5f0;',
                        default   => 'background:#f5f4f0;color:#9c9a94;border:1px solid #e8e6e0;',
                    };
                ?>
                <tr>
                    <td style="font-family:monospace;color:#9c9a94;">#<?= sprintf('%04d', $u['id']) ?></td>
                    <td>
                        <div style="display:flex;align-items:center;gap:10px;">
                            <div style="width:36px;height:36px;border-radius:50%;background:#f5f4f0;border:1px solid #e8e6e0;display:flex;align-items:center;justify-content:center;color:#9c9a94;flex-shrink:0;">
                                <i class="bi bi-person-fill"></i>
                            </div>
                            <div>
                                <div style="font-weight:600;color:#1a1916;font-size:0.875rem;"><?= esc($u['name']) ?></div>
                                <?php if ($isSelf): ?>
                                    <div style="font-size:0.7rem;font-weight:700;color:#b45309;text-transform:uppercase;letter-spacing:0.05em;">You</div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </td>
                    <td style="font-family:monospace;font-size:0.82rem;"><?= esc($u['email']) ?></td>
                    <td>
                        <span style="<?= $badgeStyle ?>padding:3px 10px;border-radius:20px;font-size:0.72rem;font-weight:700;text-transform:uppercase;letter-spacing:0.04em;">
                            <?= esc($u['role_label'] ?? 'Unassigned') ?>
                        </span>
                    </td>
                    <td style="text-align:right;padding-right:20px;">
                        <?php if ($isSelf): ?>
                            <span style="font-size:0.8rem;color:#9c9a94;display:inline-flex;align-items:center;gap:6px;">
                                <i class="bi bi-lock-fill"></i> Self-locked
                            </span>
                        <?php else: ?>
                        <form action="<?= base_url('/admin/users/assign-role/' . $u['id']) ?>" method="POST" style="display:inline-flex;align-items:center;gap:8px;margin:0;">
                            <?= csrf_field() ?>
                            <select name="role_id" class="rbac-input" style="width:auto;padding:6px 10px;font-size:0.82rem;height:34px;">
                                <?php foreach ($roles as $roleId => $roleLabel): ?>
                                    <option value="<?= $roleId ?>" <?= $u['role_id'] == $roleId ? 'selected' : '' ?>>
                                        <?= esc($roleLabel) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <button type="submit" class="clean-btn-primary" style="padding:6px 16px;font-size:0.82rem;height:34px;">
                                Save
                            </button>
                        </form>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection() ?>
