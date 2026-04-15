<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div style="display:flex;align-items:flex-end;justify-content:space-between;gap:16px;margin-bottom:28px;flex-wrap:wrap;">
    <div>
        <h2 style="font-size:1.4rem;font-weight:800;color:#1a1916;letter-spacing:-0.02em;margin:0 0 4px;">Student Management</h2>
        <p style="font-size:0.875rem;color:#9c9a94;margin:0;">All users with the student role.</p>
    </div>
    <div style="display:flex;align-items:center;gap:10px;">
        <span style="background:#edf7f1;color:#2d7a4f;border:1px solid #b7e4ca;padding:5px 14px;border-radius:20px;font-size:0.75rem;font-weight:700;text-transform:uppercase;letter-spacing:0.05em;">
            <i class="bi bi-person-badge me-1"></i>Teacher View
        </span>
        <input type="text" id="searchInput" placeholder="Search student..."
               style="background:#f5f4f0;border:1.5px solid #e8e6e0;border-radius:9px;padding:7px 14px;font-size:0.875rem;font-family:inherit;color:#1a1916;outline:none;width:200px;"
               onfocus="this.style.borderColor='#d4622a';this.style.background='#fff'"
               onblur="this.style.borderColor='#e8e6e0';this.style.background='#f5f4f0'">
    </div>
</div>

<div style="background:#fff;border:1px solid #e8e6e0;border-radius:14px;overflow:hidden;box-shadow:0 1px 3px rgba(0,0,0,0.05);">
    <div style="padding:14px 20px;border-bottom:1px solid #f5f4f0;display:flex;align-items:center;gap:10px;">
        <i class="bi bi-table" style="color:#9c9a94;"></i>
        <span style="font-size:0.875rem;font-weight:700;color:#1a1916;">Enrolled Students</span>
        <span style="background:#f5f4f0;color:#6b6860;padding:2px 10px;border-radius:20px;font-size:0.72rem;font-weight:700;"><?= count($students) ?></span>
    </div>
    <div class="table-responsive">
        <table class="rbac-table" id="studentTable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Joined</th>
                    <th style="text-align:center;">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($students)): ?>
                <tr>
                    <td colspan="5" style="text-align:center;padding:48px 20px;color:#9c9a94;">
                        <i class="bi bi-inbox" style="font-size:2rem;display:block;margin-bottom:8px;"></i>
                        No students found.
                    </td>
                </tr>
                <?php else: ?>
                <?php foreach ($students as $i => $s): ?>
                <tr>
                    <td style="color:#9c9a94;"><?= $i + 1 ?></td>
                    <td>
                        <div style="display:flex;align-items:center;gap:10px;">
                            <div style="width:34px;height:34px;border-radius:50%;background:#eef4fc;border:1px solid #bdd5f0;display:flex;align-items:center;justify-content:center;color:#2563a8;flex-shrink:0;">
                                <i class="bi bi-person-fill" style="font-size:0.9rem;"></i>
                            </div>
                            <span style="font-weight:600;color:#1a1916;"><?= esc($s['name']) ?></span>
                        </div>
                    </td>
                    <td style="font-size:0.875rem;color:#6b6860;"><?= esc($s['email']) ?></td>
                    <td style="font-size:0.82rem;color:#9c9a94;"><?= isset($s['created_at']) ? date('M j, Y', strtotime($s['created_at'])) : '—' ?></td>
                    <td style="text-align:center;">
                        <a href="<?= base_url('/students/show/' . $s['id']) ?>"
                           style="display:inline-flex;align-items:center;gap:6px;padding:6px 14px;border-radius:8px;background:#edf7f1;color:#2d7a4f;border:1px solid #b7e4ca;font-size:0.8rem;font-weight:600;text-decoration:none;transition:all 0.15s;"
                           onmouseover="this.style.background='#2d7a4f';this.style.color='#fff'"
                           onmouseout="this.style.background='#edf7f1';this.style.color='#2d7a4f'">
                            <i class="bi bi-eye"></i> View
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection() ?>
<?= $this->section('javascript') ?>
<script>
document.getElementById('searchInput').addEventListener('keyup', function () {
    const q = this.value.toLowerCase();
    document.querySelectorAll('#studentTable tbody tr').forEach(row => {
        row.style.display = row.textContent.toLowerCase().includes(q) ? '' : 'none';
    });
});
</script>
<?= $this->endSection() ?>
