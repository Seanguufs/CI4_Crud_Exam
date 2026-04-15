<?= $this->extend('layouts/main') ?>
<<<<<<< HEAD
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

=======

<?= $this->section('breadcrumb') ?>
<div class="row">
    <div class="col-sm-6"><h3 class="mb-0">Dashboard</h3></div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
        </ol>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-lg-3 col-6">
        <div class="small-box text-bg-primary">
            <div class="inner">
                <h3>150</h3>
                <p>New Orders</p>
            </div>
            <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                <path d="M2.25 2.25a.75.75 0 000 1.5h1.386c.17 0 .318.114.362.278l2.558 9.592a3.752 3.752 0 00-2.806 3.63c0 .414.336.75.75.75h15.75a.75.75 0 000-1.5H5.378A2.25 2.25 0 017.5 15h11.218a.75.75 0 00.674-.421 60.358 60.358 0 002.96-7.228.75.75 0 00-.525-.965A60.864 60.864 0 005.68 4.509l-.232-.867A1.875 1.875 0 003.636 2.25H2.25zM3.75 20.25a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0zM16.5 20.25a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0z"></path>
            </svg>
            <a href="#" class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">More info <i class="bi bi-link-45deg"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box text-bg-success">
            <div class="inner">
                <h3>53<sup class="fs-5">%</sup></h3>
                <p>Bounce Rate</p>
            </div>
            <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                <path d="M18.375 2.25c-1.035 0-1.875.84-1.875 1.875v15.75c0 1.035.84 1.875 1.875 1.875h.75c1.035 0 1.875-.84 1.875-1.875V4.125c0-1.036-.84-1.875-1.875-1.875h-.75zM9.75 8.625c0-1.036.84-1.875 1.875-1.875h.75c1.036 0 1.875.84 1.875 1.875v11.25c0 1.035-.84 1.875-1.875 1.875h-.75a1.875 1.875 0 01-1.875-1.875V8.625zM3 13.125c0-1.036.84-1.875 1.875-1.875h.75c1.036 0 1.875.84 1.875 1.875v6.75c0 1.035-.84 1.875-1.875 1.875h-.75A1.875 1.875 0 013 19.875v-6.75z"></path>
            </svg>
            <a href="#" class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">More info <i class="bi bi-link-45deg"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box text-bg-warning">
            <div class="inner">
                <h3>44</h3>
                <p>User Registrations</p>
            </div>
            <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                <path d="M6.25 6.375a4.125 4.125 0 118.25 0 4.125 4.125 0 01-8.25 0zM3.25 19.125a7.125 7.125 0 0114.25 0v.003l-.001.119a.75.75 0 01-.363.63 13.067 13.067 0 01-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 01-.364-.63l-.001-.122zM19.75 7.5a.75.75 0 00-1.5 0v2.25H16a.75.75 0 000 1.5h2.25v2.25a.75.75 0 001.5 0v-2.25H22a.75.75 0 000-1.5h-2.25V7.5z"></path>
            </svg>
            <a href="#" class="small-box-footer link-dark link-underline-opacity-0 link-underline-opacity-50-hover">More info <i class="bi bi-link-45deg"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box text-bg-danger">
            <div class="inner">
                <h3>65</h3>
                <p>Unique Visitors</p>
            </div>
            <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                <path clip-rule="evenodd" fill-rule="evenodd" d="M2.25 13.5a8.25 8.25 0 018.25-8.25.75.75 0 01.75.75v6.75H18a.75.75 0 01.75.75 8.25 8.25 0 01-16.5 0z"></path>
                <path clip-rule="evenodd" fill-rule="evenodd" d="M12.75 3a.75.75 0 01.75-.75 8.25 8.25 0 018.25 8.25.75.75 0 01-.75.75h-7.5a.75.75 0 01-.75-.75V3z"></path>
            </svg>
            <a href="#" class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">More info <i class="bi bi-link-45deg"></i></a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-7 connectedSortable">
        <div class="card mb-4">
            <div class="card-header"><h3 class="card-title">Sales Value</h3></div>
            <div class="card-body"><div id="revenue-chart"></div></div>
        </div>
        <div class="card direct-chat direct-chat-primary mb-4">
            <div class="card-header">
                <h3 class="card-title">Direct Chat</h3>
                <div class="card-tools">
                    <span title="3 New Messages" class="badge text-bg-primary">3</span>
                    <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse">
                        <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
                        <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
                    </button>
                    <button type="button" class="btn btn-tool" title="Contacts" data-lte-toggle="chat-pane">
                        <i class="bi bi-chat-text-fill"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-lte-toggle="card-remove">
                        <i class="bi bi-x-lg"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="direct-chat-messages">
                    <div class="direct-chat-msg">
                        <div class="direct-chat-infos clearfix">
                            <span class="direct-chat-name float-start">Alexander Pierce</span>
                            <span class="direct-chat-timestamp float-end">23 Jan 2:00 pm</span>
                        </div>
                        <img class="direct-chat-img" src="<?= base_url('assets/img/user1-128x128.jpg') ?>" alt="message user image" />
                        <div class="direct-chat-text">Is this template really for free? That's unbelievable!</div>
                    </div>
                    <div class="direct-chat-msg end">
                        <div class="direct-chat-infos clearfix">
                            <span class="direct-chat-name float-end">Sarah Bullock</span>
                            <span class="direct-chat-timestamp float-start">23 Jan 2:05 pm</span>
                        </div>
                        <img class="direct-chat-img" src="<?= base_url('assets/img/user3-128x128.jpg') ?>" alt="message user image" />
                        <div class="direct-chat-text">You better believe it!</div>
                    </div>
                    <div class="direct-chat-msg">
                        <div class="direct-chat-infos clearfix">
                            <span class="direct-chat-name float-start">Alexander Pierce</span>
                            <span class="direct-chat-timestamp float-end">23 Jan 5:37 pm</span>
                        </div>
                        <img class="direct-chat-img" src="<?= base_url('assets/img/user1-128x128.jpg') ?>" alt="message user image" />
                        <div class="direct-chat-text">Working with AdminLTE on a great new app! Wanna join?</div>
                    </div>
                    <div class="direct-chat-msg end">
                        <div class="direct-chat-infos clearfix">
                            <span class="direct-chat-name float-end">Sarah Bullock</span>
                            <span class="direct-chat-timestamp float-start">23 Jan 6:10 pm</span>
                        </div>
                        <img class="direct-chat-img" src="<?= base_url('assets/img/user3-128x128.jpg') ?>" alt="message user image" />
                        <div class="direct-chat-text">I would love to.</div>
                    </div>
                </div>
                <div class="direct-chat-contacts">
                    <ul class="contacts-list">
                        <li><a href="#"><img class="contacts-list-img" src="<?= base_url('assets/img/user1-128x128.jpg') ?>" alt="User Avatar" /><div class="contacts-list-info"><span class="contacts-list-name">Count Dracula<small class="contacts-list-date float-end">2/28/2023</small></span><span class="contacts-list-msg">How have you been? I was...</span></div></a></li>
                        <li><a href="#"><img class="contacts-list-img" src="<?= base_url('assets/img/user7-128x128.jpg') ?>" alt="User Avatar" /><div class="contacts-list-info"><span class="contacts-list-name">Sarah Doe<small class="contacts-list-date float-end">2/23/2023</small></span><span class="contacts-list-msg">I will be waiting for...</span></div></a></li>
                    </ul>
                </div>
            </div>
            <div class="card-footer">
                <form action="#" method="post">
                    <div class="input-group">
                        <input type="text" name="message" placeholder="Type Message ..." class="form-control" />
                        <span class="input-group-append"><button type="button" class="btn btn-primary">Send</button></span>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-5 connectedSortable">
        <div class="card text-white bg-primary bg-gradient border-primary mb-4">
            <div class="card-header border-0">
                <h3 class="card-title">Sales Value</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-primary btn-sm" data-lte-toggle="card-collapse">
                        <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
                        <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
                    </button>
                </div>
            </div>
            <div class="card-body"><div id="world-map" style="height: 220px"></div></div>
            <div class="card-footer border-0">
                <div class="row">
                    <div class="col-4 text-center">
                        <div id="sparkline-1" class="text-dark"></div>
                        <div class="text-white">Visitors</div>
                    </div>
                    <div class="col-4 text-center">
                        <div id="sparkline-2" class="text-dark"></div>
                        <div class="text-white">Online</div>
                    </div>
                    <div class="col-4 text-center">
                        <div id="sparkline-3" class="text-dark"></div>
                        <div class="text-white">Sales</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('javascript') ?>
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.min.js" integrity="sha256-+vh8GkaU7C9/wbSLIcwq82tQ2wTf44aOHA8HlBMwRI8=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/js/jsvectormap.min.js" integrity="sha256-/t1nN2956BT869E6H4V1dnt0X5pAQHPytli+1nTZm2Y=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/maps/world.js" integrity="sha256-XPpPaZlU8S/HWf7FZLAncLg2SAkP8ScUTII89x9D3lY=" crossorigin="anonymous"></script>
<script>
new Sortable(document.querySelector('.connectedSortable'), {group: 'shared', handle: '.card-header'});
document.querySelectorAll('.connectedSortable .card-header').forEach((h) => {h.style.cursor = 'move';});

const sales_chart = new ApexCharts(document.querySelector('#revenue-chart'), {
    series: [{name: 'Digital Goods', data: [28, 48, 40, 19, 86, 27, 90]}, {name: 'Electronics', data: [65, 59, 80, 81, 56, 55, 40]}],
    chart: {height: 300, type: 'area', toolbar: {show: false}},
    legend: {show: false},
    colors: ['#0d6efd', '#20c997'],
    dataLabels: {enabled: false},
    stroke: {curve: 'smooth'},
    xaxis: {type: 'datetime', categories: ['2023-01-01', '2023-02-01', '2023-03-01', '2023-04-01', '2023-05-01', '2023-06-01', '2023-07-01']},
    tooltip: {x: {format: 'MMMM yyyy'}}
});
sales_chart.render();

new jsVectorMap({selector: '#world-map', map: 'world'});

[{data: [1000, 1200, 920, 927, 931, 1027, 819, 930, 1021]}, {data: [515, 519, 520, 522, 652, 810, 370, 627, 319, 630, 921]}, {data: [15, 19, 20, 22, 33, 27, 31, 27, 19, 30, 21]}].forEach((s, i) => {
    new ApexCharts(document.querySelector('#sparkline-' + (i + 1)), {
        series: [s],
        chart: {type: 'area', height: 50, sparkline: {enabled: true}},
        stroke: {curve: 'straight'},
        fill: {opacity: 0.3},
        yaxis: {min: 0},
        colors: ['#DCE6EC']
    }).render();
});
</script>
>>>>>>> 9ba83627075c63629f030a4305e2abafb941156b
<?= $this->endSection() ?>
