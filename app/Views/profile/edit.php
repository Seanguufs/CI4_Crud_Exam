<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<form action="<?= base_url('profile/update') ?>" method="post" enctype="multipart/form-data" id="profileForm">
    <?= csrf_field() ?>

    <?php if (session('errors')): ?>
        <div class="rbac-alert error mb-4">
            <i class="bi bi-exclamation-triangle-fill" style="flex-shrink:0;margin-top:1px;"></i>
            <div>
                <strong>Please fix the following errors:</strong>
                <ul style="margin:4px 0 0;padding-left:18px;">
                    <?php foreach (session('errors') as $error): ?>
                        <li><?= esc($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    <?php endif; ?>

    <!-- Cover Header Card -->
    <div style="background:#fff;border:1px solid #e8e6e0;border-radius:16px;overflow:hidden;box-shadow:0 1px 3px rgba(0,0,0,0.05);margin-bottom:24px;">
        <div style="height:120px;background:linear-gradient(135deg,#1a1916 0%,#2d2b26 100%);"></div>
        <div style="padding:0 32px 24px;display:flex;align-items:flex-end;gap:20px;margin-top:-52px;flex-wrap:wrap;">
            <!-- Avatar -->
            <div style="position:relative;flex-shrink:0;">
                <?php if (!empty($user['profile_image'])): ?>
                    <img id="preview" src="<?= base_url('uploads/profiles/' . esc($user['profile_image'])) ?>" alt="Profile"
                         style="width:104px;height:104px;border-radius:50%;object-fit:cover;border:4px solid #fff;box-shadow:0 4px 12px rgba(0,0,0,0.12);display:block;">
                <?php else: ?>
                    <div id="preview" style="width:104px;height:104px;border-radius:50%;background:#f5f4f0;border:4px solid #fff;box-shadow:0 4px 12px rgba(0,0,0,0.12);display:flex;align-items:center;justify-content:center;color:#9c9a94;">
                        <i class="bi bi-person-fill" style="font-size:3.5rem;"></i>
                    </div>
                <?php endif; ?>
                <label for="profile_image" title="Change photo"
                       style="position:absolute;bottom:2px;right:2px;width:32px;height:32px;border-radius:50%;background:#d4622a;color:#fff;border:3px solid #fff;display:flex;align-items:center;justify-content:center;cursor:pointer;box-shadow:0 2px 8px rgba(212,98,42,0.4);transition:transform 0.2s;"
                       onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'">
                    <i class="bi bi-camera-fill" style="font-size:0.8rem;"></i>
                </label>
                <input type="file" name="profile_image" id="profile_image" class="d-none" accept="image/jpeg,image/png,image/webp">
            </div>
            <!-- Name + actions -->
            <div style="flex:1;padding-bottom:4px;min-width:200px;">
                <h4 style="font-size:1.1rem;font-weight:800;color:#1a1916;margin:0 0 2px;letter-spacing:-0.02em;"><?= esc($user['fullname']) ?></h4>
                <p style="font-size:0.82rem;color:#9c9a94;margin:0;">Editing your profile</p>
                <p id="fileInfo" style="font-size:0.75rem;color:#d4622a;margin:4px 0 0;display:none;"></p>
            </div>
            <div style="display:flex;gap:10px;padding-bottom:4px;flex-wrap:wrap;">
                <a href="<?= base_url('profile') ?>" class="btn-rbac-secondary">
                    <i class="bi bi-x-lg"></i> Discard
                </a>
                <button type="submit" class="clean-btn-primary">
                    <i class="bi bi-check-lg"></i> Save Changes
                </button>
            </div>
        </div>
    </div>

    <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;">

        <!-- Personal Details -->
        <div style="background:#fff;border:1px solid #e8e6e0;border-radius:14px;overflow:hidden;box-shadow:0 1px 3px rgba(0,0,0,0.05);">
            <div style="padding:14px 20px;border-bottom:1px solid #f5f4f0;display:flex;align-items:center;gap:8px;">
                <i class="bi bi-person-vcard-fill" style="color:#2563a8;"></i>
                <span style="font-size:0.75rem;font-weight:700;text-transform:uppercase;letter-spacing:0.07em;color:#2563a8;">Personal Details</span>
            </div>
            <div style="padding:20px;">
                <div style="margin-bottom:16px;">
                    <label style="display:block;font-size:0.82rem;font-weight:600;color:#6b6860;margin-bottom:6px;">Full Name <span style="color:#c0392b;">*</span></label>
                    <input type="text" name="fullname" class="rbac-input <?= session('errors.fullname') ? 'border-danger' : '' ?>"
                           value="<?= old('fullname', esc($user['fullname'])) ?>" required placeholder="Your full name">
                    <?php if (session('errors.fullname')): ?>
                        <div style="font-size:0.75rem;color:#c0392b;margin-top:4px;display:flex;align-items:center;gap:4px;"><i class="bi bi-exclamation-circle-fill"></i><?= session('errors.fullname') ?></div>
                    <?php endif; ?>
                </div>
                <div style="margin-bottom:16px;">
                    <label style="display:block;font-size:0.82rem;font-weight:600;color:#6b6860;margin-bottom:6px;">Email / Username <span style="color:#c0392b;">*</span></label>
                    <input type="text" name="username" class="rbac-input <?= session('errors.username') ? 'border-danger' : '' ?>"
                           value="<?= old('username', esc($user['username'])) ?>" required placeholder="your@email.com">
                    <?php if (session('errors.username')): ?>
                        <div style="font-size:0.75rem;color:#c0392b;margin-top:4px;display:flex;align-items:center;gap:4px;"><i class="bi bi-exclamation-circle-fill"></i><?= session('errors.username') ?></div>
                    <?php endif; ?>
                </div>
                <div style="margin-bottom:16px;">
                    <label style="display:block;font-size:0.82rem;font-weight:600;color:#6b6860;margin-bottom:6px;">Phone Number</label>
                    <div style="position:relative;">
                        <i class="bi bi-telephone" style="position:absolute;left:12px;top:50%;transform:translateY(-50%);color:#9c9a94;pointer-events:none;"></i>
                        <input type="tel" name="phone" class="rbac-input" style="padding-left:34px;"
                               value="<?= old('phone', esc($user['phone'] ?? '')) ?>" placeholder="+63 9XX XXX XXXX">
                    </div>
                </div>
                <div>
                    <label style="display:flex;justify-content:space-between;font-size:0.82rem;font-weight:600;color:#6b6860;margin-bottom:6px;">
                        <span>Home Address</span>
                        <span id="addrCount" style="font-weight:400;color:#9c9a94;">0 / 255</span>
                    </label>
                    <textarea name="address" id="addressField" rows="3" class="rbac-input" maxlength="255"
                              placeholder="Street, City, Province"><?= old('address', esc($user['address'] ?? '')) ?></textarea>
                </div>
            </div>
        </div>

        <!-- Right column -->
        <div style="display:flex;flex-direction:column;gap:20px;">

            <!-- Academic Record -->
            <div style="background:#fff;border:1px solid #e8e6e0;border-radius:14px;overflow:hidden;box-shadow:0 1px 3px rgba(0,0,0,0.05);">
                <div style="padding:14px 20px;border-bottom:1px solid #f5f4f0;display:flex;align-items:center;gap:8px;">
                    <i class="bi bi-mortarboard-fill" style="color:#2d7a4f;"></i>
                    <span style="font-size:0.75rem;font-weight:700;text-transform:uppercase;letter-spacing:0.07em;color:#2d7a4f;">Academic Record</span>
                </div>
                <div style="padding:20px;">
                    <div style="margin-bottom:16px;">
                        <label style="display:block;font-size:0.82rem;font-weight:600;color:#6b6860;margin-bottom:6px;">Student ID</label>
                        <input type="text" name="student_id" class="rbac-input"
                               value="<?= old('student_id', esc($user['student_id'] ?? '')) ?>" placeholder="e.g. 2024-00001">
                    </div>
                    <div style="margin-bottom:16px;">
                        <label style="display:block;font-size:0.82rem;font-weight:600;color:#6b6860;margin-bottom:6px;">Course / Program</label>
                        <input type="text" name="course" class="rbac-input"
                               value="<?= old('course', esc($user['course'] ?? '')) ?>" placeholder="e.g. BS Computer Science">
                    </div>
                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;">
                        <div>
                            <label style="display:block;font-size:0.82rem;font-weight:600;color:#6b6860;margin-bottom:6px;">Year Level</label>
                            <select name="year_level" class="rbac-input">
                                <option value="">— Select —</option>
                                <?php for ($i = 1; $i <= 5; $i++): ?>
                                    <option value="<?= $i ?>" <?= old('year_level', $user['year_level'] ?? '') == $i ? 'selected' : '' ?>>Year <?= $i ?></option>
                                <?php endfor; ?>
                            </select>
                        </div>
                        <div>
                            <label style="display:block;font-size:0.82rem;font-weight:600;color:#6b6860;margin-bottom:6px;">Section</label>
                            <input type="text" name="section" class="rbac-input"
                                   value="<?= old('section', esc($user['section'] ?? '')) ?>" placeholder="e.g. A, B, C">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Change Password -->
            <div style="background:#fff;border:1px solid #e8e6e0;border-radius:14px;overflow:hidden;box-shadow:0 1px 3px rgba(0,0,0,0.05);">
                <div style="padding:14px 20px;border-bottom:1px solid #f5f4f0;display:flex;align-items:center;gap:8px;">
                    <i class="bi bi-shield-lock-fill" style="color:#b45309;"></i>
                    <span style="font-size:0.75rem;font-weight:700;text-transform:uppercase;letter-spacing:0.07em;color:#b45309;">Change Password</span>
                    <span style="font-size:0.75rem;color:#9c9a94;font-weight:400;text-transform:none;letter-spacing:0;">— leave blank to keep current</span>
                </div>
                <div style="padding:20px;">
                    <div style="margin-bottom:14px;">
                        <label style="display:block;font-size:0.82rem;font-weight:600;color:#6b6860;margin-bottom:6px;">New Password</label>
                        <div style="position:relative;">
                            <input type="password" name="new_password" id="newPassword" class="rbac-input" style="padding-right:40px;"
                                   placeholder="Min. 8 characters" autocomplete="new-password">
                            <button type="button" class="toggle-pw" data-target="newPassword"
                                    style="position:absolute;right:12px;top:50%;transform:translateY(-50%);background:none;border:none;color:#9c9a94;cursor:pointer;padding:0;">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>
                    </div>
                    <div>
                        <label style="display:block;font-size:0.82rem;font-weight:600;color:#6b6860;margin-bottom:6px;">Confirm Password</label>
                        <div style="position:relative;">
                            <input type="password" name="confirm_password" id="confirmPassword" class="rbac-input" style="padding-right:40px;"
                                   placeholder="Repeat new password" autocomplete="new-password">
                            <button type="button" class="toggle-pw" data-target="confirmPassword"
                                    style="position:absolute;right:12px;top:50%;transform:translateY(-50%);background:none;border:none;color:#9c9a94;cursor:pointer;padding:0;">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>
                        <div id="pwMismatch" style="display:none;font-size:0.75rem;color:#c0392b;margin-top:4px;align-items:center;gap:4px;">
                            <i class="bi bi-exclamation-circle-fill"></i> Passwords do not match
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</form>

<?= $this->endSection() ?>
<?= $this->section('javascript') ?>
<script>
(function () {
    // Avatar preview
    const fileInput = document.getElementById('profile_image');
    const fileInfo  = document.getElementById('fileInfo');
    fileInput.addEventListener('change', function () {
        const file = this.files[0];
        if (!file) return;
        if (file.size > 2 * 1024 * 1024) { alert('Image must be under 2 MB.'); this.value = ''; return; }
        fileInfo.textContent = file.name + ' (' + (file.size / 1024).toFixed(0) + ' KB)';
        fileInfo.style.display = 'block';
        const reader = new FileReader();
        reader.onload = (e) => {
            const prev = document.getElementById('preview');
            if (prev.tagName === 'IMG') {
                prev.src = e.target.result;
            } else {
                const img = document.createElement('img');
                img.id = 'preview'; img.alt = 'Profile'; img.src = e.target.result;
                img.style.cssText = prev.style.cssText;
                prev.parentNode.replaceChild(img, prev);
            }
        };
        reader.readAsDataURL(file);
    });

    // Address counter
    const addr = document.getElementById('addressField');
    const addrCount = document.getElementById('addrCount');
    const updateCount = () => addrCount.textContent = addr.value.length + ' / 255';
    addr.addEventListener('input', updateCount); updateCount();

    // Password toggle
    document.querySelectorAll('.toggle-pw').forEach(btn => {
        btn.addEventListener('click', function () {
            const input = document.getElementById(this.dataset.target);
            const icon  = this.querySelector('i');
            input.type = input.type === 'password' ? 'text' : 'password';
            icon.className = input.type === 'password' ? 'bi bi-eye' : 'bi bi-eye-slash';
        });
    });

    // Password match
    const newPw = document.getElementById('newPassword');
    const confPw = document.getElementById('confirmPassword');
    const mismatch = document.getElementById('pwMismatch');
    function checkPw() {
        const show = confPw.value && newPw.value !== confPw.value;
        mismatch.style.display = show ? 'flex' : 'none';
        confPw.style.borderColor = show ? '#c0392b' : '';
    }
    newPw.addEventListener('input', checkPw);
    confPw.addEventListener('input', checkPw);
    document.getElementById('profileForm').addEventListener('submit', function (e) {
        if (newPw.value && newPw.value !== confPw.value) { e.preventDefault(); confPw.focus(); mismatch.style.display = 'flex'; }
    });
})();
</script>
<?= $this->endSection() ?>
