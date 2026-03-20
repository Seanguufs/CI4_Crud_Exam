<?php
$role   = session('user')['role'] ?? 'guest';
$name   = session('user')['fullname'] ?? 'User';
$seg    = service('uri')->getSegment(1);
$subseg = service('uri')->getSegment(2);

$roleColor  = match($role) { 'admin'=>'#c0392b','teacher'=>'#2d7a4f','coordinator'=>'#b45309',default=>'#2563a8' };
$roleBg     = match($role) { 'admin'=>'#fdf2f1','teacher'=>'#edf7f1','coordinator'=>'#fef9ee',default=>'#eef4fc' };
$roleBorder = match($role) { 'admin'=>'#f5c6c2','teacher'=>'#b7e4ca','coordinator'=>'#f5d9a0',default=>'#bdd5f0' };
?>

<aside style="width:220px;min-width:220px;height:100vh;position:sticky;top:0;background:#fff;border-right:1px solid #e8e6e0;display:flex;flex-direction:column;flex-shrink:0;font-family:'DM Sans',sans-serif;">

    <!-- Brand -->
    <div style="padding:20px 20px 16px;border-bottom:1px solid #f5f4f0;">
        <a href="<?= base_url() ?>" style="display:flex;align-items:center;gap:10px;text-decoration:none;">
            <div style="width:34px;height:34px;border-radius:9px;background:<?= $roleColor ?>;display:flex;align-items:center;justify-content:center;color:#fff;font-size:1rem;flex-shrink:0;">
                <i class="bi bi-shield-check"></i>
            </div>
            <div>
                <div style="font-weight:800;font-size:0.95rem;color:#1a1916;letter-spacing:-0.02em;line-height:1.1;">RBAC</div>
                <div style="font-size:0.65rem;color:#9c9a94;font-weight:500;text-transform:uppercase;letter-spacing:0.06em;">System</div>
            </div>
        </a>
    </div>

    <!-- Nav -->
    <nav style="flex:1;padding:12px 10px;overflow-y:auto;display:flex;flex-direction:column;gap:2px;">

        <?php
        // Section label helper
        function navLabel(string $text): string {
            return '<div style="font-size:0.62rem;font-weight:700;text-transform:uppercase;letter-spacing:0.1em;color:#c4c2bc;padding:10px 10px 4px;margin-top:4px;">' . $text . '</div>';
        }
        // Link helper
        function navLink(string $href, string $icon, string $label, bool $active, string $roleColor): string {
            $bg    = $active ? 'background:#f5f4f0;' : '';
            $color = $active ? "color:#1a1916;font-weight:700;" : "color:#6b6860;font-weight:500;";
            $bar   = $active ? "border-left:3px solid {$roleColor};padding-left:9px;" : "border-left:3px solid transparent;padding-left:9px;";
            return '<a href="' . $href . '" style="display:flex;align-items:center;gap:10px;padding:8px 10px 8px 9px;border-radius:8px;text-decoration:none;font-size:0.82rem;transition:background 0.15s;' . $bg . $color . $bar . '"
                onmouseover="if(!this.classList.contains(\'active-link\'))this.style.background=\'#f5f4f0\'"
                onmouseout="if(!this.classList.contains(\'active-link\'))this.style.background=\'transparent\'">
                <i class="bi ' . $icon . '" style="font-size:0.95rem;width:16px;flex-shrink:0;"></i>
                ' . $label . '
            </a>';
        }
        // Locked link helper
        function navLocked(string $icon, string $label): string {
            return '<a href="' . base_url('forbidden') . '" style="display:flex;align-items:center;gap:10px;padding:8px 10px 8px 12px;border-radius:8px;font-size:0.82rem;color:#d4d0c8;text-decoration:none;border-left:3px solid transparent;transition:background 0.15s;"
                onmouseover="this.style.background=\'#fdf2f1\'" onmouseout="this.style.background=\'transparent\'">
                <i class="bi ' . $icon . '" style="font-size:0.95rem;width:16px;flex-shrink:0;"></i>
                ' . $label . '
                <i class="bi bi-lock-fill" style="font-size:0.6rem;margin-left:auto;"></i>
            </a>';
        }
        ?>

        <?php if ($role === 'admin'): ?>

            <?= navLabel('Overview') ?>
            <?= navLink(base_url('dashboard'), 'bi-grid-2x2-fill', 'Dashboard', $seg === 'dashboard', $roleColor) ?>

            <?= navLabel('Management') ?>
            <?= navLink(base_url('students'),    'bi-people-fill',   'Students',  $seg === 'students', $roleColor) ?>
            <?= navLink(base_url('admin/roles'), 'bi-shield-lock-fill','Roles',   $seg === 'admin' && $subseg === 'roles', $roleColor) ?>
            <?= navLink(base_url('admin/users'), 'bi-person-gear',   'Users',     $seg === 'admin' && $subseg === 'users', $roleColor) ?>

            <?= navLabel('Account') ?>
            <?= navLink(base_url('profile'),     'bi-person-circle', 'My Profile', $seg === 'profile', $roleColor) ?>

        <?php elseif ($role === 'teacher' || $role === 'coordinator'): ?>

            <?= navLabel('Overview') ?>
            <?= navLink(base_url('dashboard'), 'bi-grid-2x2-fill', 'Dashboard', $seg === 'dashboard', $roleColor) ?>

            <?= navLabel('Academics') ?>
            <?= navLink(base_url('students'), 'bi-people-fill', 'Students', $seg === 'students', $roleColor) ?>
            <?= navLocked('bi-shield-lock-fill', 'Roles') ?>
            <?= navLocked('bi-person-gear',      'Users') ?>

            <?= navLabel('Account') ?>
            <?= navLink(base_url('profile'), 'bi-person-circle', 'My Profile', $seg === 'profile', $roleColor) ?>

        <?php else: ?>

            <?= navLabel('Overview') ?>
            <?= navLink(base_url('student/dashboard'), 'bi-house-fill',    'Dashboard', $seg === 'student',  $roleColor) ?>

            <?= navLabel('Account') ?>
            <?= navLink(base_url('profile'),           'bi-person-circle', 'My Profile',$seg === 'profile',  $roleColor) ?>
            <?= navLink(base_url('profile/edit'),      'bi-pencil-fill',   'Edit Profile', $seg === 'profile' && $subseg === 'edit', $roleColor) ?>

            <?= navLabel('Restricted') ?>
            <?= navLocked('bi-people-fill',      'Students') ?>
            <?= navLocked('bi-shield-lock-fill', 'Roles') ?>
            <?= navLocked('bi-person-gear',      'Users') ?>

        <?php endif; ?>

    </nav>

    <!-- User Footer -->
    <div style="border-top:1px solid #f5f4f0;padding:14px 14px;">
        <div class="dropdown dropup" style="width:100%;">
            <button data-bs-toggle="dropdown"
                    style="width:100%;background:none;border:none;padding:0;cursor:pointer;font-family:inherit;text-align:left;">
                <div style="display:flex;align-items:center;gap:10px;padding:8px 10px;border-radius:10px;transition:background 0.15s;"
                     onmouseover="this.style.background='#f5f4f0'" onmouseout="this.style.background='transparent'">
                    <div style="width:34px;height:34px;border-radius:50%;background:<?= $roleBg ?>;border:1.5px solid <?= $roleBorder ?>;display:flex;align-items:center;justify-content:center;color:<?= $roleColor ?>;font-size:1rem;flex-shrink:0;">
                        <i class="bi bi-person-fill"></i>
                    </div>
                    <div style="flex:1;min-width:0;">
                        <div style="font-size:0.8rem;font-weight:700;color:#1a1916;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;"><?= esc($name) ?></div>
                        <div style="font-size:0.65rem;font-weight:700;text-transform:uppercase;letter-spacing:0.05em;color:<?= $roleColor ?>;"><?= esc($role) ?></div>
                    </div>
                    <i class="bi bi-chevron-up" style="font-size:0.65rem;color:#9c9a94;flex-shrink:0;"></i>
                </div>
            </button>
            <ul class="dropdown-menu dropdown-menu-end" style="min-width:180px;margin-bottom:6px;">
                <li><a class="dropdown-item" href="<?= base_url('profile') ?>" style="padding:9px 14px;font-size:0.875rem;"><i class="bi bi-person me-2" style="color:#9c9a94;"></i>My Profile</a></li>
                <li><a class="dropdown-item" href="<?= base_url('profile/edit') ?>" style="padding:9px 14px;font-size:0.875rem;"><i class="bi bi-pencil me-2" style="color:#9c9a94;"></i>Edit Profile</a></li>
                <li><hr class="dropdown-divider" style="margin:4px 0;border-color:#e8e6e0;"></li>
                <li><a class="dropdown-item" href="<?= base_url('logout') ?>" style="padding:9px 14px;font-size:0.875rem;color:#c0392b;"><i class="bi bi-box-arrow-right me-2"></i>Sign Out</a></li>
            </ul>
        </div>
    </div>

</aside>
