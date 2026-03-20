<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<?php
$db   = \Config\Database::connect();
$role = session('user')['role'] ?? 'guest';
$name = session('user')['fullname'] ?? session('user')['name'] ?? 'User';
$hour = (int) date('H');
$greeting = $hour < 12 ? 'Morning' : ($hour < 17 ? 'Afternoon' : 'Evening');

$totalUsers    = $db->table('users')->countAllResults();
$totalRoles    = $db->table('roles')->countAllResults();
$sRole         = $db->table('roles')->where('name','student')->get()->getRowArray();
$totalStudents = $sRole ? $db->table('users')->where('role_id',$sRole['id'])->countAllResults() : 0;
$tRole         = $db->table('roles')->where('name','teacher')->get()->getRowArray();
$totalTeachers = $tRole ? $db->table('users')->where('role_id',$tRole['id'])->countAllResults() : 0;

$roleColor = match($role) { 'admin'=>'#c0392b','teacher'=>'#2d7a4f','coordinator'=>'#b45309',default=>'#2563a8' };
$roleBg    = match($role) { 'admin'=>'#fdf2f1','teacher'=>'#edf7f1','coordinator'=>'#fef9ee',default=>'#eef4fc' };
$roleBorder= match($role) { 'admin'=>'#f5c6c2','teacher'=>'#b7e4ca','coordinator'=>'#f5d9a0',default=>'#bdd5f0' };

$matrix = [
    ['/dashboard',        true,  true,  false],
    ['/students',         true,  true,  false],
    ['/students/show',    true,  true,  false],
    ['/profile',          true,  true,  true ],
    ['/profile/edit',     true,  true,  true ],
    ['/admin/roles',      true,  false, false],
    ['/admin/users',      true,  false, false],
    ['/student/dashboard',false, false, true ],
];
?>

<!-- Page Header -->
<div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:28px;gap:16px;flex-wrap:wrap;">
    <div>
        <div style="font-size:0.72rem;font-weight:700;color:#9c9a94;text-transform:uppercase;letter-spacing:0.1em;margin-bottom:4px;">Good <?= $greeting ?></div>
        <h1 style="font-size:1.6rem;font-weight:800;color:#1a1916;letter-spacing:-0.03em;margin:0;"><?= esc($name) ?></h1>
    </div>
    <div style="display:flex;align-items:center;gap:10px;flex-wrap:wrap;">
        <span style="background:<?= $roleBg ?>;color:<?= $roleColor ?>;border:1px solid <?= $roleBorder ?>;padding:6px 16px;border-radius:20px;font-size:0.75rem;font-weight:700;text-transform:uppercase;letter-spacing:0.06em;">
            <i class="bi bi-shield-fill me-1"></i><?= esc($role) ?>
        </span>
        <span style="font-size:0.82rem;color:#9c9a94;"><?= date('D, M j, Y') ?></span>
    </div>
</div>

<!-- Main Grid: Left panel + Right content -->
<div style="display:grid;grid-template-columns:260px 1fr;gap:24px;align-items:start;">

    <!-- ── LEFT PANEL ── -->
    <div style="display:flex;flex-direction:column;gap:16px;">

        <!-- Role Identity Card -->
        <div style="background:#1a1916;border-radius:16px;padding:24px;color:#fff;position:relative;overflow:hidden;">
            <div style="position:absolute;top:-20px;right:-20px;width:100px;height:100px;border-radius:50%;background:<?= $roleColor ?>;opacity:0.15;"></div>
            <div style="position:absolute;bottom:-30px;left:-10px;width:80px;height:80px;border-radius:50%;background:<?= $roleColor ?>;opacity:0.08;"></div>
            <div style="position:relative;z-index:1;">
                <div style="width:48px;height:48px;border-radius:12px;background:<?= $roleColor ?>;display:flex;align-items:center;justify-content:center;font-size:1.3rem;color:#fff;margin-bottom:16px;">
                    <i class="bi bi-shield-fill"></i>
                </div>
                <div style="font-size:0.7rem;font-weight:700;color:rgba(255,255,255,0.4);text-transform:uppercase;letter-spacing:0.1em;margin-bottom:4px;">Active Role</div>
                <div style="font-size:1.4rem;font-weight:800;color:#fff;text-transform:capitalize;letter-spacing:-0.02em;margin-bottom:16px;"><?= esc($role) ?></div>
                <?php
                $perms = match($role) {
                    'admin'                => [['bi-grid-2x2','Dashboard'],['bi-people','Students'],['bi-shield-lock','Role CRUD'],['bi-person-gear','User Assignment']],
                    'teacher','coordinator'=> [['bi-grid-2x2','Dashboard'],['bi-people','View Students'],['bi-eye','Student Details'],['bi-person-circle','Profile']],
                    default                => [['bi-house','Student Dashboard'],['bi-person-circle','View Profile'],['bi-pencil','Edit Profile']],
                };
                foreach ($perms as [$icon, $label]):
                ?>
                <div style="display:flex;align-items:center;gap:8px;padding:6px 0;border-bottom:1px solid rgba(255,255,255,0.06);font-size:0.8rem;color:rgba(255,255,255,0.55);">
                    <i class="bi <?= $icon ?>" style="color:<?= $roleColor ?>;width:14px;flex-shrink:0;"></i> <?= $label ?>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Quick Actions -->
        <div style="background:#fff;border:1px solid #e8e6e0;border-radius:14px;overflow:hidden;">
            <div style="padding:12px 16px;border-bottom:1px solid #f5f4f0;">
                <span style="font-size:0.72rem;font-weight:700;text-transform:uppercase;letter-spacing:0.07em;color:#9c9a94;">Quick Actions</span>
            </div>
            <div style="padding:8px;">
                <?php if ($role === 'admin'): ?>
                    <?php $links = [
                        [base_url('admin/roles/create'), 'bi-plus-circle', '#c0392b', 'Create New Role'],
                        [base_url('admin/users'),        'bi-person-gear', '#2563a8', 'Manage Users'],
                        [base_url('admin/roles'),        'bi-shield-lock', '#b45309', 'View All Roles'],
                        [base_url('students'),           'bi-people',      '#2d7a4f', 'Browse Students'],
                    ]; ?>
                <?php elseif ($role === 'teacher' || $role === 'coordinator'): ?>
                    <?php $links = [
                        [base_url('students'),     'bi-people',        '#2d7a4f', 'View Students'],
                        [base_url('profile'),      'bi-person-circle', '#2563a8', 'My Profile'],
                        [base_url('profile/edit'), 'bi-pencil',        '#b45309', 'Edit Profile'],
                    ]; ?>
                <?php else: ?>
                    <?php $links = [
                        [base_url('student/dashboard'), 'bi-house',         '#2563a8', 'My Dashboard'],
                        [base_url('profile'),           'bi-person-circle', '#2d7a4f', 'View Profile'],
                        [base_url('profile/edit'),      'bi-pencil',        '#b45309', 'Edit Profile'],
                    ]; ?>
                <?php endif; ?>
                <?php foreach ($links as [$href, $icon, $color, $label]): ?>
                <a href="<?= $href ?>" style="display:flex;align-items:center;gap:10px;padding:9px 10px;border-radius:8px;text-decoration:none;color:#6b6860;font-size:0.82rem;font-weight:500;transition:background 0.15s;"
                   onmouseover="this.style.background='#f5f4f0'" onmouseout="this.style.background='transparent'">
                    <div style="width:28px;height:28px;border-radius:7px;background:<?= $color ?>18;color:<?= $color ?>;display:flex;align-items:center;justify-content:center;font-size:0.8rem;flex-shrink:0;">
                        <i class="bi <?= $icon ?>"></i>
                    </div>
                    <?= $label ?>
                </a>
                <?php endforeach; ?>
                <a href="<?= base_url('logout') ?>" style="display:flex;align-items:center;gap:10px;padding:9px 10px;border-radius:8px;text-decoration:none;color:#c0392b;font-size:0.82rem;font-weight:500;transition:background 0.15s;margin-top:4px;border-top:1px solid #f5f4f0;"
                   onmouseover="this.style.background='#fdf2f1'" onmouseout="this.style.background='transparent'">
                    <div style="width:28px;height:28px;border-radius:7px;background:#fdf2f1;color:#c0392b;display:flex;align-items:center;justify-content:center;font-size:0.8rem;flex-shrink:0;">
                        <i class="bi bi-box-arrow-right"></i>
                    </div>
                    Sign Out
                </a>
            </div>
        </div>

    </div>

    <!-- ── RIGHT CONTENT ── -->
    <div style="display:flex;flex-direction:column;gap:20px;">

        <!-- Stat Cards Row -->
        <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:14px;">
            <?php
            $stats = [
                ['Users',    $totalUsers,    'bi-people-fill',      '#eef4fc','#2563a8', base_url('admin/users')],
                ['Roles',    $totalRoles,    'bi-shield-fill',      '#fdf2f1','#c0392b', base_url('admin/roles')],
                ['Students', $totalStudents, 'bi-mortarboard-fill', '#edf7f1','#2d7a4f', base_url('students')],
                ['Teachers', $totalTeachers, 'bi-person-workspace', '#fef9ee','#b45309', '#'],
            ];
            foreach ($stats as [$label, $val, $icon, $bg, $color, $href]):
            ?>
            <a href="<?= $href ?>" style="background:#fff;border:1px solid #e8e6e0;border-radius:14px;padding:18px 20px;text-decoration:none;display:block;transition:box-shadow 0.2s,transform 0.15s;"
               onmouseover="this.style.boxShadow='0 4px 16px rgba(0,0,0,0.08)';this.style.transform='translateY(-2px)'"
               onmouseout="this.style.boxShadow='none';this.style.transform='none'">
                <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:12px;">
                    <div style="width:36px;height:36px;border-radius:9px;background:<?= $bg ?>;color:<?= $color ?>;display:flex;align-items:center;justify-content:center;font-size:0.95rem;">
                        <i class="bi <?= $icon ?>"></i>
                    </div>
                    <i class="bi bi-arrow-up-right" style="color:#d4d0c8;font-size:0.75rem;"></i>
                </div>
                <div style="font-size:2rem;font-weight:800;color:#1a1916;line-height:1;margin-bottom:4px;"><?= $val ?></div>
                <div style="font-size:0.72rem;font-weight:700;color:#9c9a94;text-transform:uppercase;letter-spacing:0.07em;"><?= $label ?></div>
            </a>
            <?php endforeach; ?>
        </div>

        <!-- Access Matrix -->
        <div style="background:#fff;border:1px solid #e8e6e0;border-radius:14px;overflow:hidden;">
            <div style="padding:16px 20px;border-bottom:1px solid #f5f4f0;display:flex;align-items:center;justify-content:space-between;">
                <div>
                    <div style="font-size:0.9rem;font-weight:700;color:#1a1916;">Permission Matrix</div>
                    <div style="font-size:0.75rem;color:#9c9a94;margin-top:2px;">Route-level access per role</div>
                </div>
                <div style="display:flex;gap:16px;font-size:0.72rem;font-weight:700;text-transform:uppercase;letter-spacing:0.05em;">
                    <span style="color:#c0392b;">Admin</span>
                    <span style="color:#2d7a4f;">Teacher</span>
                    <span style="color:#2563a8;">Student</span>
                </div>
            </div>
            <div style="display:grid;grid-template-columns:1fr repeat(3,80px);">
                <!-- Header -->
                <div style="padding:9px 20px;font-size:0.7rem;font-weight:700;text-transform:uppercase;letter-spacing:0.07em;color:#9c9a94;background:#fafaf8;border-bottom:1px solid #e8e6e0;">Route</div>
                <div style="padding:9px 0;font-size:0.7rem;font-weight:700;text-transform:uppercase;letter-spacing:0.07em;color:#c0392b;background:#fafaf8;border-bottom:1px solid #e8e6e0;text-align:center;">A</div>
                <div style="padding:9px 0;font-size:0.7rem;font-weight:700;text-transform:uppercase;letter-spacing:0.07em;color:#2d7a4f;background:#fafaf8;border-bottom:1px solid #e8e6e0;text-align:center;">T</div>
                <div style="padding:9px 0;font-size:0.7rem;font-weight:700;text-transform:uppercase;letter-spacing:0.07em;color:#2563a8;background:#fafaf8;border-bottom:1px solid #e8e6e0;text-align:center;">S</div>
                <!-- Rows -->
                <?php foreach ($matrix as $i => [$route, $a, $t, $s]):
                    $rowBg = $i % 2 === 0 ? '#fff' : '#fafaf8';
                    $check = '<i class="bi bi-check-circle-fill" style="color:#2d7a4f;font-size:0.9rem;"></i>';
                    $dash  = '<i class="bi bi-x-circle" style="color:#e8e6e0;font-size:0.9rem;"></i>';
                ?>
                <div style="padding:10px 20px;font-family:monospace;font-size:0.78rem;color:#6b6860;background:<?= $rowBg ?>;border-bottom:1px solid #f5f4f0;"><?= $route ?></div>
                <div style="padding:10px 0;text-align:center;background:<?= $rowBg ?>;border-bottom:1px solid #f5f4f0;"><?= $a ? $check : $dash ?></div>
                <div style="padding:10px 0;text-align:center;background:<?= $rowBg ?>;border-bottom:1px solid #f5f4f0;"><?= $t ? $check : $dash ?></div>
                <div style="padding:10px 0;text-align:center;background:<?= $rowBg ?>;border-bottom:1px solid #f5f4f0;"><?= $s ? $check : $dash ?></div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Role Cards -->
        <?php
        $allRoles = $db->table('roles')
            ->select('roles.*, COUNT(users.id) as user_count')
            ->join('users','users.role_id = roles.id','left')
            ->groupBy('roles.id')
            ->get()->getResultArray();
        $roleStyles = [
            'admin'       => ['#fdf2f1','#c0392b','#f5c6c2','bi-shield-fill'],
            'teacher'     => ['#edf7f1','#2d7a4f','#b7e4ca','bi-person-workspace'],
            'student'     => ['#eef4fc','#2563a8','#bdd5f0','bi-mortarboard-fill'],
            'coordinator' => ['#fef9ee','#b45309','#f5d9a0','bi-diagram-3-fill'],
        ];
        ?>
        <div>
            <div style="font-size:0.72rem;font-weight:700;text-transform:uppercase;letter-spacing:0.07em;color:#9c9a94;margin-bottom:12px;">System Roles</div>
            <div style="display:grid;grid-template-columns:repeat(<?= min(count($allRoles), 4) ?>,1fr);gap:12px;">
                <?php foreach ($allRoles as $r):
                    [$rbg, $rc, $rbd, $ri] = $roleStyles[$r['name']] ?? ['#f5f4f0','#6b6860','#e8e6e0','bi-person-fill'];
                ?>
                <div style="background:#fff;border:1px solid #e8e6e0;border-radius:12px;padding:16px;position:relative;overflow:hidden;">
                    <div style="position:absolute;top:-10px;right:-10px;width:60px;height:60px;border-radius:50%;background:<?= $rc ?>;opacity:0.06;"></div>
                    <div style="width:36px;height:36px;border-radius:9px;background:<?= $rbg ?>;color:<?= $rc ?>;display:flex;align-items:center;justify-content:center;font-size:0.95rem;margin-bottom:12px;border:1px solid <?= $rbd ?>;">
                        <i class="bi <?= $ri ?>"></i>
                    </div>
                    <div style="font-size:0.875rem;font-weight:700;color:#1a1916;text-transform:capitalize;margin-bottom:2px;"><?= esc($r['label']) ?></div>
                    <div style="font-size:0.72rem;color:#9c9a94;margin-bottom:10px;font-family:monospace;">@<?= esc($r['name']) ?></div>
                    <div style="display:flex;align-items:center;justify-content:space-between;">
                        <span style="font-size:1.2rem;font-weight:800;color:<?= $rc ?>;"><?= $r['user_count'] ?></span>
                        <span style="font-size:0.7rem;color:#9c9a94;">user<?= $r['user_count'] != 1 ? 's' : '' ?></span>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

    </div>
</div>

<?= $this->endSection() ?>
