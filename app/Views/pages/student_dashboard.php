<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<?php $u = $user ?? []; ?>

<!-- Header -->
<div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:28px;flex-wrap:wrap;gap:12px;">
    <div>
        <div style="font-size:0.72rem;font-weight:700;color:#9c9a94;text-transform:uppercase;letter-spacing:0.1em;margin-bottom:4px;">Student Dashboard</div>
        <h1 style="font-size:1.5rem;font-weight:800;color:#1a1916;letter-spacing:-0.03em;margin:0;"><?= esc($u['fullname'] ?? 'Student') ?></h1>
        <div style="font-size:0.8rem;color:#9c9a94;margin-top:3px;"><?= date('l, F j, Y') ?></div>
    </div>
    <a href="<?= base_url('profile/edit') ?>" style="display:inline-flex;align-items:center;gap:7px;padding:10px 20px;background:#2563a8;color:#fff;border-radius:10px;font-size:0.85rem;font-weight:700;text-decoration:none;">
        <i class="bi bi-pencil-fill"></i> Edit Profile
    </a>
</div>

<!-- Profile + Info -->
<div style="display:grid;grid-template-columns:260px 1fr;gap:20px;align-items:start;">

    <!-- Left: Avatar Card -->
    <div style="background:#fff;border:1px solid #e8e6e0;border-radius:16px;padding:28px 20px;display:flex;flex-direction:column;align-items:center;gap:12px;text-align:center;">
        <div style="width:80px;height:80px;border-radius:50%;background:#eef4fc;border:3px solid #bdd5f0;display:flex;align-items:center;justify-content:center;color:#2563a8;font-size:2rem;">
            <?php if (!empty($u['profile_image'])): ?>
                <img src="<?= base_url('uploads/profiles/' . esc($u['profile_image'])) ?>" style="width:100%;height:100%;border-radius:50%;object-fit:cover;">
            <?php else: ?>
                <i class="bi bi-person-fill"></i>
            <?php endif; ?>
        </div>
        <div>
            <div style="font-size:1rem;font-weight:800;color:#1a1916;"><?= esc($u['fullname'] ?? '—') ?></div>
            <div style="display:inline-block;margin-top:5px;padding:3px 12px;background:#eef4fc;color:#2563a8;border:1px solid #bdd5f0;border-radius:20px;font-size:0.72rem;font-weight:700;text-transform:uppercase;letter-spacing:0.05em;">Student</div>
        </div>
        <div style="width:100%;border-top:1px solid #f5f4f0;padding-top:14px;display:flex;flex-direction:column;gap:8px;">
            <div style="display:flex;justify-content:space-between;font-size:0.8rem;">
                <span style="color:#9c9a94;font-weight:600;">Student ID</span>
                <span style="color:#1a1916;font-weight:700;font-family:monospace;"><?= esc($u['student_id'] ?? '—') ?></span>
            </div>
            <div style="display:flex;justify-content:space-between;font-size:0.8rem;">
                <span style="color:#9c9a94;font-weight:600;">Year Level</span>
                <span style="color:#1a1916;font-weight:700;"><?= $u['year_level'] ? $u['year_level'] . ' Year' : '—' ?></span>
            </div>
            <div style="display:flex;justify-content:space-between;font-size:0.8rem;">
                <span style="color:#9c9a94;font-weight:600;">Section</span>
                <span style="color:#1a1916;font-weight:700;"><?= esc($u['section'] ?? '—') ?></span>
            </div>
        </div>
    </div>

    <!-- Right: Details -->
    <div style="display:flex;flex-direction:column;gap:16px;">

        <!-- Academic Info -->
        <div style="background:#fff;border:1px solid #e8e6e0;border-radius:16px;overflow:hidden;">
            <div style="padding:14px 20px;border-bottom:1px solid #f5f4f0;display:flex;align-items:center;gap:8px;">
                <i class="bi bi-mortarboard-fill" style="color:#2563a8;"></i>
                <span style="font-size:0.85rem;font-weight:700;color:#1a1916;">Academic Information</span>
            </div>
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:0;">
                <div style="padding:16px 20px;border-right:1px solid #f5f4f0;border-bottom:1px solid #f5f4f0;">
                    <div style="font-size:0.72rem;font-weight:700;color:#9c9a94;text-transform:uppercase;letter-spacing:0.07em;margin-bottom:6px;">Course</div>
                    <div style="font-size:0.95rem;font-weight:700;color:#1a1916;"><?= esc($u['course'] ?? '—') ?></div>
                </div>
                <div style="padding:16px 20px;border-bottom:1px solid #f5f4f0;">
                    <div style="font-size:0.72rem;font-weight:700;color:#9c9a94;text-transform:uppercase;letter-spacing:0.07em;margin-bottom:6px;">Year & Section</div>
                    <div style="font-size:0.95rem;font-weight:700;color:#1a1916;">
                        <?= $u['year_level'] ? $u['year_level'] . ' Year' : '—' ?> <?= !empty($u['section']) ? '— ' . esc($u['section']) : '' ?>
                    </div>
                </div>
                <div style="padding:16px 20px;border-right:1px solid #f5f4f0;">
                    <div style="font-size:0.72rem;font-weight:700;color:#9c9a94;text-transform:uppercase;letter-spacing:0.07em;margin-bottom:6px;">Student ID</div>
                    <div style="font-size:0.95rem;font-weight:700;color:#1a1916;font-family:monospace;"><?= esc($u['student_id'] ?? '—') ?></div>
                </div>
                <div style="padding:16px 20px;">
                    <div style="font-size:0.72rem;font-weight:700;color:#9c9a94;text-transform:uppercase;letter-spacing:0.07em;margin-bottom:6px;">Enrolled Since</div>
                    <div style="font-size:0.95rem;font-weight:700;color:#1a1916;"><?= !empty($u['created_at']) ? date('M j, Y', strtotime($u['created_at'])) : '—' ?></div>
                </div>
            </div>
        </div>

        <!-- Contact Info -->
        <div style="background:#fff;border:1px solid #e8e6e0;border-radius:16px;overflow:hidden;">
            <div style="padding:14px 20px;border-bottom:1px solid #f5f4f0;display:flex;align-items:center;gap:8px;">
                <i class="bi bi-person-lines-fill" style="color:#2563a8;"></i>
                <span style="font-size:0.85rem;font-weight:700;color:#1a1916;">Contact Details</span>
            </div>
            <div style="padding:4px 0;">
                <div style="display:flex;align-items:center;gap:14px;padding:13px 20px;border-bottom:1px solid #f5f4f0;">
                    <div style="width:32px;height:32px;border-radius:8px;background:#f5f4f0;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                        <i class="bi bi-envelope-fill" style="font-size:0.85rem;color:#6b6860;"></i>
                    </div>
                    <div>
                        <div style="font-size:0.72rem;font-weight:700;color:#9c9a94;text-transform:uppercase;letter-spacing:0.06em;">Email Address</div>
                        <div style="font-size:0.875rem;font-weight:600;color:#1a1916;margin-top:2px;"><?= esc($u['email'] ?? '—') ?></div>
                    </div>
                </div>
                <div style="display:flex;align-items:center;gap:14px;padding:13px 20px;border-bottom:1px solid #f5f4f0;">
                    <div style="width:32px;height:32px;border-radius:8px;background:#f5f4f0;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                        <i class="bi bi-telephone-fill" style="font-size:0.85rem;color:#6b6860;"></i>
                    </div>
                    <div>
                        <div style="font-size:0.72rem;font-weight:700;color:#9c9a94;text-transform:uppercase;letter-spacing:0.06em;">Phone Number</div>
                        <div style="font-size:0.875rem;font-weight:600;color:#1a1916;margin-top:2px;"><?= esc($u['phone'] ?? '—') ?></div>
                    </div>
                </div>
                <div style="display:flex;align-items:center;gap:14px;padding:13px 20px;">
                    <div style="width:32px;height:32px;border-radius:8px;background:#f5f4f0;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                        <i class="bi bi-geo-alt-fill" style="font-size:0.85rem;color:#6b6860;"></i>
                    </div>
                    <div>
                        <div style="font-size:0.72rem;font-weight:700;color:#9c9a94;text-transform:uppercase;letter-spacing:0.06em;">Home Address</div>
                        <div style="font-size:0.875rem;font-weight:600;color:#1a1916;margin-top:2px;"><?= esc($u['address'] ?? '—') ?></div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<?= $this->endSection() ?>
