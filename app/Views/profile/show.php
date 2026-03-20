<?= $this->extend('layouts/main') ?>
<<<<<<< HEAD
<?= $this->section('content') ?>

<div style="display:grid;grid-template-columns:280px 1fr;gap:24px;align-items:start;">

    <!-- Left: Profile Card -->
    <div style="background:#fff;border:1px solid #e8e6e0;border-radius:16px;overflow:hidden;box-shadow:0 1px 3px rgba(0,0,0,0.05);">
        <div style="height:80px;background:linear-gradient(135deg,#1a1916 0%,#2d2b26 100%);"></div>
        <div style="padding:0 24px 24px;text-align:center;margin-top:-44px;">
            <div style="width:88px;height:88px;border-radius:50%;background:#f5f4f0;border:4px solid #fff;box-shadow:0 4px 12px rgba(0,0,0,0.12);display:flex;align-items:center;justify-content:center;color:#9c9a94;margin:0 auto 14px;">
                <i class="bi bi-person-fill" style="font-size:2.8rem;"></i>
            </div>
            <h5 style="font-size:1.05rem;font-weight:800;color:#1a1916;margin:0 0 4px;letter-spacing:-0.02em;"><?= esc($user['fullname']) ?></h5>
            <p style="font-size:0.82rem;color:#9c9a94;margin:0 0 14px;">@<?= esc($user['username']) ?></p>
            <span style="background:#f5f4f0;color:#6b6860;padding:4px 14px;border-radius:20px;font-size:0.72rem;font-weight:700;text-transform:uppercase;letter-spacing:0.05em;display:inline-block;margin-bottom:18px;">
                <?= esc(session('user')['role'] ?? 'Student') ?>
            </span>
            <a href="<?= base_url('profile/edit') ?>" class="clean-btn-primary" style="width:100%;justify-content:center;">
                <i class="bi bi-pencil"></i> Edit Profile
            </a>
        </div>
        <div style="border-top:1px solid #f5f4f0;padding:16px 24px;display:flex;flex-direction:column;gap:10px;">
            <div style="display:flex;justify-content:space-between;align-items:center;">
                <span style="font-size:0.82rem;color:#9c9a94;font-weight:500;">Joined</span>
                <span style="font-size:0.82rem;color:#1a1916;font-weight:600;"><?= isset($user['created_at']) ? date('M Y', strtotime($user['created_at'])) : 'Unknown' ?></span>
            </div>
            <div style="display:flex;justify-content:space-between;align-items:center;">
                <span style="font-size:0.82rem;color:#9c9a94;font-weight:500;">Status</span>
                <span style="font-size:0.82rem;color:#2d7a4f;font-weight:700;display:flex;align-items:center;gap:5px;">
                    <i class="bi bi-circle-fill" style="font-size:0.45rem;"></i> Active
                </span>
=======

<?= $this->section('content') ?>
<div class="row">
    <div class="col-md-4">
        <div class="card card-primary card-outline">
            <div class="card-body box-profile">
                <div class="text-center">
                    <?php if (!empty($user['profile_image'])): ?>
                        <img class="profile-user-img img-fluid img-circle" 
                             src="<?= base_url('uploads/profiles/' . esc($user['profile_image'])) ?>" 
                             alt="User profile picture" style="width: 150px; height: 150px; object-fit: cover;">
                    <?php else: ?>
                        <img class="profile-user-img img-fluid img-circle" 
                             src="<?= base_url('assets/images/avatar4.png') ?>" 
                             alt="User profile picture">
                    <?php endif; ?>
                </div>
                <h3 class="profile-username text-center"><?= esc($user['fullname']) ?></h3>
                <p class="text-muted text-center"><?= esc($user['course'] ?? 'No Course') ?></p>
                <a href="<?= base_url('profile/edit') ?>" class="btn btn-primary btn-block"><b>Edit Profile</b></a>
>>>>>>> 9ba83627075c63629f030a4305e2abafb941156b
            </div>
        </div>
    </div>

<<<<<<< HEAD
    <!-- Right: Account Info -->
    <div style="background:#fff;border:1px solid #e8e6e0;border-radius:14px;overflow:hidden;box-shadow:0 1px 3px rgba(0,0,0,0.05);">
        <div style="padding:14px 20px;border-bottom:1px solid #f5f4f0;display:flex;align-items:center;gap:8px;">
            <i class="bi bi-person-vcard-fill" style="color:#2563a8;"></i>
            <span style="font-size:0.75rem;font-weight:700;text-transform:uppercase;letter-spacing:0.07em;color:#2563a8;">Account Details</span>
        </div>
        <table style="width:100%;border-collapse:collapse;">
            <tbody>
                <tr>
                    <td style="padding:14px 20px;font-size:0.82rem;font-weight:600;color:#9c9a94;width:180px;border-bottom:1px solid #f5f4f0;">Full Name</td>
                    <td style="padding:14px 20px;font-size:0.875rem;font-weight:600;color:#1a1916;border-bottom:1px solid #f5f4f0;"><?= esc($user['fullname']) ?></td>
                </tr>
                <tr>
                    <td style="padding:14px 20px;font-size:0.82rem;font-weight:600;color:#9c9a94;border-bottom:1px solid #f5f4f0;">Username / Email</td>
                    <td style="padding:14px 20px;font-size:0.875rem;font-weight:600;color:#1a1916;border-bottom:1px solid #f5f4f0;"><?= esc($user['username']) ?></td>
                </tr>
                <tr>
                    <td style="padding:14px 20px;font-size:0.82rem;font-weight:600;color:#9c9a94;">Role</td>
                    <td style="padding:14px 20px;font-size:0.875rem;font-weight:600;color:#1a1916;text-transform:capitalize;"><?= esc(session('user')['role'] ?? '—') ?></td>
                </tr>
            </tbody>
        </table>
    </div>

</div>

=======
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Student Information</h3>
            </div>
            <div class="card-body">
                <dl class="row">
                    <dt class="col-sm-4">Student ID</dt>
                    <dd class="col-sm-8"><?= esc($user['student_id'] ?? 'N/A') ?></dd>

                    <dt class="col-sm-4">Full Name</dt>
                    <dd class="col-sm-8"><?= esc($user['fullname']) ?></dd>

                    <dt class="col-sm-4">Username</dt>
                    <dd class="col-sm-8"><?= esc($user['username']) ?></dd>

                    <dt class="col-sm-4">Course</dt>
                    <dd class="col-sm-8"><?= esc($user['course'] ?? 'N/A') ?></dd>

                    <dt class="col-sm-4">Year Level</dt>
                    <dd class="col-sm-8"><?= esc($user['year_level'] ?? 'N/A') ?></dd>

                    <dt class="col-sm-4">Section</dt>
                    <dd class="col-sm-8"><?= esc($user['section'] ?? 'N/A') ?></dd>

                    <dt class="col-sm-4">Phone</dt>
                    <dd class="col-sm-8"><?= esc($user['phone'] ?? 'N/A') ?></dd>

                    <dt class="col-sm-4">Address</dt>
                    <dd class="col-sm-8"><?= esc($user['address'] ?? 'N/A') ?></dd>

                    <dt class="col-sm-4">Account Created</dt>
                    <dd class="col-sm-8"><?= esc($user['created_at'] ?? 'N/A') ?></dd>

                    <dt class="col-sm-4">Last Updated</dt>
                    <dd class="col-sm-8"><?= esc($user['updated_at'] ?? 'N/A') ?></dd>
                </dl>
            </div>
        </div>
    </div>
</div>
>>>>>>> 9ba83627075c63629f030a4305e2abafb941156b
<?= $this->endSection() ?>
