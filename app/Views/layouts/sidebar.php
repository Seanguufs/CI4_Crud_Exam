<?php 
$role = session('user')['role'] ?? 'guest'; 
$segment = service('uri')->getSegment(1); 
$subsegment = service('uri')->getSegment(2);
?>
<aside class="sidebar-wrapper" style="background-color: #000000; border-right: 1px solid rgba(255,255,255,0.05); border-radius: 0;">
    <a href="<?= base_url() ?>" class="d-flex align-items-center text-white text-decoration-none px-4 py-4 mb-2">
        <i class="bi bi-fan me-2" style="font-size: 1.25rem; color: #818cf8; animation: spin 4s linear infinite;"></i> 
        <span style="font-weight: 700; font-size: 1.15rem; letter-spacing: -0.02em;">Jurado</span>
    </a>
    
    <nav class="sidebar-nav px-3">
        <?php if ($role === 'admin'): ?>
            <!-- Show admin links -->
            <div class="nav-group-title mt-2 mb-2 px-3 text-uppercase" style="font-size: 0.65rem; font-weight: 700; color: #4b5563; letter-spacing: 0.1em;">Admin Topography</div>
            
            <a href="<?= base_url('dashboard') ?>" class="nav-item-link <?= ($segment === 'dashboard') ? 'active' : '' ?>" style="color: <?= ($segment === 'dashboard') ? '#fff' : '#a1a1aa' ?>;">
                <i class="bi bi-grid-1x2<?= ($segment === 'dashboard') ? '-fill' : '' ?>"></i> Platform Hub
            </a>
            <a href="<?= base_url('students') ?>" class="nav-item-link <?= ($segment === 'students') ? 'active' : '' ?>" style="color: <?= ($segment === 'students') ? '#fff' : '#a1a1aa' ?>;">
                <i class="bi bi-people<?= ($segment === 'students') ? '-fill' : '' ?>"></i> Students Grid
            </a>
            
            <div class="nav-group-title mt-4 mb-2 px-3 text-uppercase" style="font-size: 0.65rem; font-weight: 700; color: #4b5563; letter-spacing: 0.1em;">Security Core</div>
            
            <a href="<?= base_url('admin/roles') ?>" class="nav-item-link <?= ($segment === 'admin' && $subsegment === 'roles') ? 'active' : '' ?>" style="color: <?= ($segment === 'admin' && $subsegment === 'roles') ? '#fb7185' : '#a1a1aa' ?>;">
                <i class="bi bi-shield-lock<?= ($segment === 'admin' && $subsegment === 'roles') ? '-fill' : '' ?>"></i> Role Architecture
            </a>
            <a href="<?= base_url('admin/users') ?>" class="nav-item-link <?= ($segment === 'admin' && $subsegment === 'users') ? 'active' : '' ?>" style="color: <?= ($segment === 'admin' && $subsegment === 'users') ? '#fb7185' : '#a1a1aa' ?>;">
                <i class="bi bi-person-bounding-box"></i> Identity Matrix
            </a>

        <?php elseif ($role === 'teacher'): ?>
            <!-- Show teacher links -->
            <div class="nav-group-title mt-2 mb-2 px-3 text-uppercase" style="font-size: 0.65rem; font-weight: 700; color: #4b5563; letter-spacing: 0.1em;">Educator Console</div>
            
            <a href="<?= base_url('dashboard') ?>" class="nav-item-link <?= ($segment === 'dashboard') ? 'active' : '' ?>" style="color: <?= ($segment === 'dashboard') ? '#fff' : '#a1a1aa' ?>;">
                <i class="bi bi-grid-1x2<?= ($segment === 'dashboard') ? '-fill' : '' ?>"></i> Metrics Overview
            </a>
            <a href="<?= base_url('students') ?>" class="nav-item-link <?= ($segment === 'students') ? 'active' : '' ?>" style="color: <?= ($segment === 'students') ? '#fff' : '#a1a1aa' ?>;">
                <i class="bi bi-book<?= ($segment === 'students') ? '-fill' : '' ?>"></i> Roster Access
            </a>

        <?php else: ?>
            <!-- Show student links -->
            <div class="nav-group-title mt-2 mb-2 px-3 text-uppercase" style="font-size: 0.65rem; font-weight: 700; color: #4b5563; letter-spacing: 0.1em;">Student Terminal</div>
            
            <a href="<?= base_url('student/dashboard') ?>" class="nav-item-link <?= ($segment === 'student' || $segment === 'dashboard') ? 'active' : '' ?>" style="color: <?= ($segment === 'student' || $segment === 'dashboard') ? '#fff' : '#a1a1aa' ?>;">
                <i class="bi bi-house-door<?= ($segment === 'student' || $segment === 'dashboard') ? '-fill' : '' ?>"></i> Academic Hub
            </a>
            
            <div class="nav-group-title mt-4 mb-2 px-3 text-uppercase" style="font-size: 0.65rem; font-weight: 700; color: #4b5563; letter-spacing: 0.1em;">Identity Control</div>
            <a href="<?= base_url('profile') ?>" class="nav-item-link <?= ($segment === 'profile' && empty($subsegment)) ? 'active' : '' ?>" style="color: <?= ($segment === 'profile' && empty($subsegment)) ? '#fff' : '#a1a1aa' ?>;">
                <i class="bi bi-person-vcard<?= ($segment === 'profile' && empty($subsegment)) ? '-fill' : '' ?>"></i> Public Matrix
            </a>
            <a href="<?= base_url('profile/edit') ?>" class="nav-item-link <?= ($segment === 'profile' && $subsegment === 'edit') ? 'active' : '' ?>" style="color: <?= ($segment === 'profile' && $subsegment === 'edit') ? '#fff' : '#a1a1aa' ?>;">
                <i class="bi bi-sliders2"></i> Edit Protocol
            </a>
        <?php endif; ?>
    </nav>
    
    <div class="p-3 mt-auto mx-2 mb-3" style="border-top: 1px solid rgba(255,255,255,0.05);">
        <div class="d-flex align-items-center gap-3 mb-3 px-2 py-2 rounded" style="background: rgba(255,255,255,0.03);">
            <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 32px; height: 32px; background: rgba(99,102,241,0.1); border: 1px solid rgba(99,102,241,0.2); color: #818cf8;">
                <i class="bi bi-lightning-charge-fill" style="font-size: 0.85rem;"></i>
            </div>
            <div class="overflow-hidden">
                <div class="text-truncate" style="font-size: 0.8rem; font-weight: 600; color: #f8fafc; letter-spacing: -0.01em;"><?= esc(session('user')['fullname'] ?? 'Offline') ?></div>
                <div class="text-truncate" style="font-size: 0.65rem; font-weight: 700; color: #34d399; text-transform: uppercase; letter-spacing: 0.05em;"><span style="color: #10b981; margin-right: 4px;">●</span> <?= esc($role) ?></div>
            </div>
        </div>
        <a href="<?= base_url('logout') ?>" class="nav-item-link text-decoration-none px-3 d-flex align-items-center gap-2 rounded" style="color: #a1a1aa; transition: all 0.2s;" onmouseover="this.style.color='#fb7185'; this.style.background='rgba(2fb,113,133,0.05)'" onmouseout="this.style.color='#a1a1aa'; this.style.background='transparent'">
            <i class="bi bi-power"></i> Terminate Session
        </a>
    </div>
</aside>
<style>
@keyframes spin { 100% { transform: rotate(360deg); } }
.nav-item-link {
    display: flex; align-items: center; gap: 0.75rem;
    padding: 0.6rem 1rem; border-radius: 8px;
    font-size: 0.9rem; font-weight: 500;
    transition: all 0.2s;
    margin-bottom: 0.25rem;
}
.nav-item-link:hover {
    background: rgba(255,255,255,0.05); color: #fff !important;
}
.nav-item-link.active {
    background: rgba(99,102,241,0.1); color: #fff !important;
    box-shadow: inset 2px 0 0 #818cf8;
}
</style>
