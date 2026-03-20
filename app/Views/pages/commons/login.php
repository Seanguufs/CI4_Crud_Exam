<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign In — RBAC</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            min-height: 100vh;
            background: #0a0a0f;
            display: flex;
            overflow: hidden;
        }

        /* ── Left Panel ── */
        .left-panel {
            width: 55%;
            position: relative;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 60px;
            overflow: hidden;
        }

        .left-panel::before {
            content: '';
            position: absolute;
            inset: 0;
            background: radial-gradient(ellipse at 30% 20%, rgba(99,102,241,0.35) 0%, transparent 60%),
                        radial-gradient(ellipse at 80% 80%, rgba(168,85,247,0.25) 0%, transparent 55%),
                        radial-gradient(ellipse at 60% 50%, rgba(59,130,246,0.15) 0%, transparent 50%);
            z-index: 0;
        }

        .grid-bg {
            position: absolute;
            inset: 0;
            background-image:
                linear-gradient(rgba(255,255,255,0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,0.03) 1px, transparent 1px);
            background-size: 40px 40px;
            z-index: 0;
        }

        .left-content {
            position: relative;
            z-index: 1;
            text-align: center;
            max-width: 420px;
        }

        .logo-ring {
            width: 90px;
            height: 90px;
            border-radius: 24px;
            background: linear-gradient(135deg, #6366f1, #a855f7);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 32px;
            font-size: 2.5rem;
            color: #fff;
            box-shadow: 0 0 40px rgba(99,102,241,0.5);
        }

        .left-content h1 {
            font-size: 2.8rem;
            font-weight: 800;
            color: #fff;
            letter-spacing: -0.04em;
            line-height: 1.1;
            margin-bottom: 16px;
        }

        .left-content h1 span {
            background: linear-gradient(135deg, #818cf8, #c084fc);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .left-content p {
            color: rgba(255,255,255,0.5);
            font-size: 1rem;
            line-height: 1.7;
            margin-bottom: 40px;
        }

        .role-cards {
            display: flex;
            gap: 10px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .role-card {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 8px 16px;
            border-radius: 12px;
            font-size: 0.8rem;
            font-weight: 600;
            border: 1px solid;
        }

        .role-card.admin   { background: rgba(220,38,38,0.1);  border-color: rgba(220,38,38,0.3);  color: #fca5a5; }
        .role-card.teacher { background: rgba(22,163,74,0.1);  border-color: rgba(22,163,74,0.3);  color: #86efac; }
        .role-card.student { background: rgba(37,99,235,0.1);  border-color: rgba(37,99,235,0.3);  color: #93c5fd; }

        .floating-card {
            position: absolute;
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 16px;
            padding: 16px 20px;
            backdrop-filter: blur(10px);
            z-index: 1;
        }

        .floating-card.top-right {
            top: 60px; right: 40px;
            font-size: 0.75rem;
            color: rgba(255,255,255,0.6);
        }

        .floating-card.bottom-left {
            bottom: 80px; left: 40px;
            font-size: 0.75rem;
            color: rgba(255,255,255,0.6);
        }

        .stat-num { font-size: 1.4rem; font-weight: 800; color: #fff; }

        /* ── Right Panel ── */
        .right-panel {
            width: 45%;
            background: #fff;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 60px 56px;
            position: relative;
        }

        .right-panel::before {
            content: '';
            position: absolute;
            top: 0; left: 0;
            width: 4px;
            height: 100%;
            background: linear-gradient(180deg, #6366f1, #a855f7, #3b82f6);
        }

        .form-header { margin-bottom: 36px; }
        .form-header .eyebrow {
            font-size: 0.72rem;
            font-weight: 700;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: #6366f1;
            margin-bottom: 8px;
        }
        .form-header h2 {
            font-size: 2rem;
            font-weight: 800;
            color: #0f172a;
            letter-spacing: -0.03em;
            margin-bottom: 6px;
        }
        .form-header p { color: #94a3b8; font-size: 0.9rem; }

        .field-group { margin-bottom: 20px; }
        .field-label {
            display: block;
            font-size: 0.8rem;
            font-weight: 600;
            color: #475569;
            margin-bottom: 8px;
            letter-spacing: 0.02em;
        }

        .input-wrap {
            position: relative;
        }

        .input-wrap .icon {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            font-size: 1rem;
            pointer-events: none;
        }

        .input-wrap input {
            width: 100%;
            padding: 14px 16px 14px 44px;
            border: 1.5px solid #e2e8f0;
            border-radius: 12px;
            font-size: 0.92rem;
            font-family: inherit;
            color: #0f172a;
            background: #f8fafc;
            transition: all 0.2s;
            outline: none;
        }

        .input-wrap input:focus {
            border-color: #6366f1;
            background: #fff;
            box-shadow: 0 0 0 4px rgba(99,102,241,0.1);
        }

        .input-wrap .toggle-pwd {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #94a3b8;
            cursor: pointer;
            padding: 4px;
            font-size: 1rem;
            transition: color 0.2s;
        }
        .input-wrap .toggle-pwd:hover { color: #6366f1; }

        .btn-login {
            width: 100%;
            padding: 15px;
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            border: none;
            border-radius: 12px;
            color: #fff;
            font-size: 0.95rem;
            font-weight: 700;
            font-family: inherit;
            cursor: pointer;
            transition: all 0.25s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            margin-top: 8px;
            letter-spacing: 0.01em;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 28px rgba(99,102,241,0.4);
        }

        .btn-login:active { transform: translateY(0); }

        .divider {
            display: flex;
            align-items: center;
            gap: 12px;
            margin: 24px 0;
            color: #cbd5e1;
            font-size: 0.8rem;
        }
        .divider::before, .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: #e2e8f0;
        }

        .register-link {
            text-align: center;
            font-size: 0.875rem;
            color: #94a3b8;
        }
        .register-link a {
            color: #6366f1;
            font-weight: 700;
            text-decoration: none;
        }
        .register-link a:hover { text-decoration: underline; }

        .alert-box {
            padding: 12px 16px;
            border-radius: 10px;
            font-size: 0.85rem;
            margin-bottom: 20px;
            display: flex;
            align-items: flex-start;
            gap: 10px;
        }
        .alert-box.error   { background: #fef2f2; color: #b91c1c; border: 1px solid #fecaca; }
        .alert-box.success { background: #f0fdf4; color: #15803d; border: 1px solid #bbf7d0; }

        @media (max-width: 768px) {
            .left-panel { display: none; }
            .right-panel { width: 100%; padding: 40px 28px; }
        }
    </style>
</head>
<body>

<!-- Left Panel -->
<div class="left-panel">
    <div class="grid-bg"></div>

    <div class="floating-card top-right">
        <div class="stat-num">3</div>
        <div>Role Levels</div>
    </div>

    <div class="floating-card bottom-left">
        <div class="stat-num">RBAC</div>
        <div>Access Control</div>
    </div>

    <div class="left-content">
        <div class="logo-ring">
            <i class="bi bi-shield-check"></i>
        </div>
        <h1>RBAC <span>System</span></h1>
        <p>A role-based access control system for managing students, teachers, and administrators in one unified platform.</p>
        <div class="role-cards">
            <div class="role-card admin"><i class="bi bi-shield-fill"></i> Admin</div>
            <div class="role-card teacher"><i class="bi bi-person-workspace"></i> Teacher</div>
            <div class="role-card student"><i class="bi bi-mortarboard-fill"></i> Student</div>
        </div>
    </div>
</div>

<!-- Right Panel -->
<div class="right-panel">
    <div class="form-header">
        <div class="eyebrow">Welcome back</div>
        <h2>Sign in to your account</h2>
        <p>Enter your credentials to access the system</p>
    </div>

    <?php if (session()->getFlashdata('notif_error')): ?>
        <div class="alert-box error">
            <i class="bi bi-exclamation-circle-fill" style="margin-top:1px;flex-shrink:0;"></i>
            <span><?= session()->getFlashdata('notif_error') ?></span>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('notif_success')): ?>
        <div class="alert-box success">
            <i class="bi bi-check-circle-fill" style="margin-top:1px;flex-shrink:0;"></i>
            <span><?= session()->getFlashdata('notif_success') ?></span>
        </div>
    <?php endif; ?>

    <form action="<?= base_url('login') ?>" method="POST" autocomplete="off">

        <div class="field-group">
            <label class="field-label">Email Address</label>
            <div class="input-wrap">
                <i class="bi bi-envelope icon"></i>
                <input type="email" name="inputEmail" placeholder="you@school.edu.ph" autocomplete="off" required>
            </div>
        </div>

        <div class="field-group">
            <label class="field-label">Password</label>
            <div class="input-wrap">
                <i class="bi bi-lock icon"></i>
                <input type="password" name="inputPassword" id="pwdInput" placeholder="••••••••" autocomplete="new-password" required>
                <button type="button" class="toggle-pwd" onclick="togglePwd()">
                    <i class="bi bi-eye" id="eyeIcon"></i>
                </button>
            </div>
        </div>

        <button type="submit" class="btn-login">
            <i class="bi bi-arrow-right-circle-fill"></i> Sign In
        </button>
    </form>

    <div class="divider">or</div>

    <p class="register-link">
        Don't have an account? <a href="<?= base_url('register') ?>">Create one here</a>
    </p>
</div>

<script>
function togglePwd() {
    const inp = document.getElementById('pwdInput');
    const ico = document.getElementById('eyeIcon');
    inp.type = inp.type === 'password' ? 'text' : 'password';
    ico.className = inp.type === 'password' ? 'bi bi-eye' : 'bi bi-eye-slash';
}
</script>
</body>
</html>
