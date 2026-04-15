<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>403 Unauthorized — RBAC</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'DM Sans', sans-serif; background: #fafaf8; min-height: 100vh; display: flex; align-items: center; justify-content: center; padding: 24px; }
        .card { background: #fff; border: 1px solid #e8e6e0; border-radius: 20px; padding: 56px 48px; max-width: 480px; width: 100%; text-align: center; box-shadow: 0 4px 24px rgba(0,0,0,0.06); }
        .icon-wrap { width: 80px; height: 80px; border-radius: 20px; background: #fdf2f1; display: flex; align-items: center; justify-content: center; margin: 0 auto 28px; font-size: 2.2rem; color: #c0392b; }
        h1 { font-size: 1.6rem; font-weight: 800; color: #1a1916; letter-spacing: -0.03em; margin-bottom: 8px; }
        .code { font-size: 0.75rem; font-weight: 700; color: #9c9a94; text-transform: uppercase; letter-spacing: 0.1em; margin-bottom: 16px; }
        p { font-size: 0.9rem; color: #6b6860; line-height: 1.7; margin-bottom: 28px; }
        .role-pill { display: inline-block; padding: 4px 12px; border-radius: 20px; font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 28px; }
        .btn { display: inline-flex; align-items: center; gap: 8px; padding: 11px 24px; border-radius: 10px; font-size: 0.875rem; font-weight: 700; text-decoration: none; font-family: inherit; transition: all 0.2s; }
        .btn-primary { background: #1a1916; color: #fff; }
        .btn-primary:hover { background: #2d2b26; transform: translateY(-1px); }
        .divider { width: 40px; height: 3px; background: #e8e6e0; border-radius: 2px; margin: 0 auto 28px; }
    </style>
</head>
<body>
<?php
$role = session('user')['role'] ?? '';
$roleColor = match($role) { 'admin'=>'#c0392b','teacher'=>'#2d7a4f','coordinator'=>'#b45309',default=>'#2563a8' };
$roleBg    = match($role) { 'admin'=>'#fdf2f1','teacher'=>'#edf7f1','coordinator'=>'#fef9ee',default=>'#eef4fc' };
$dashLink  = match($role) { 'student'=>base_url('student/dashboard'), default=>base_url('dashboard') };
if (!session()->has('user')) $dashLink = base_url('login');
?>
<div class="card">
    <div class="icon-wrap"><i class="bi bi-shield-x"></i></div>
    <div class="code">Error 403</div>
    <h1>Access Denied</h1>
    <div class="divider"></div>
    <?php if ($role): ?>
    <span class="role-pill" style="background:<?= $roleBg ?>;color:<?= $roleColor ?>;border:1px solid <?= $roleColor ?>30;">
        Logged in as: <?= esc($role) ?>
    </span>
    <?php endif; ?>
    <p>You don't have permission to view this page. This area requires a different access level than your current role.</p>
    <a href="<?= $dashLink ?>" class="btn btn-primary">
        <i class="bi bi-arrow-left"></i> Back to Dashboard
    </a>
</div>
</body>
</html>
