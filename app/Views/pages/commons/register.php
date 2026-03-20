<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register — RBAC</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            min-height: 100vh;
            background: #f1f5f9;
            display: flex;
            flex-direction: column;
        }

        /* ── Top Banner ── */
        .top-banner {
            background: #0a0a0f;
            padding: 20px 48px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: relative;
            overflow: hidden;
        }

        .top-banner::after {
            content: '';
            position: absolute;
            bottom: 0; left: 0; right: 0;
            height: 2px;
            background: linear-gradient(90deg, #6366f1, #a855f7, #3b82f6, #6366f1);
            background-size: 200% 100%;
            animation: shimmer 3s linear infinite;
        }

        @keyframes shimmer { 0% { background-position: 0% 0%; } 100% { background-position: 200% 0%; } }

        .banner-logo {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
        }

        .banner-logo .icon-box {
            width: 38px; height: 38px;
            background: linear-gradient(135deg, #6366f1, #a855f7);
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            color: #fff; font-size: 1.1rem;
        }

        .banner-logo span {
            font-size: 1.1rem;
            font-weight: 800;
            color: #fff;
            letter-spacing: -0.02em;
        }

        .banner-right {
            font-size: 0.85rem;
            color: rgba(255,255,255,0.5);
        }

        .banner-right a {
            color: #818cf8;
            font-weight: 600;
            text-decoration: none;
        }

        /* ── Main Content ── */
        .page-body {
            flex: 1;
            display: flex;
            align-items: flex-start;
            justify-content: center;
            padding: 48px 24px;
        }

        .register-container {
            width: 100%;
            max-width: 680px;
        }

        .page-title {
            text-align: center;
            margin-bottom: 32px;
        }

        .page-title .badge-tag {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: rgba(99,102,241,0.1);
            color: #6366f1;
            border: 1px solid rgba(99,102,241,0.2);
            border-radius: 20px;
            padding: 4px 14px;
            font-size: 0.75rem;
            font-weight: 700;
            letter-spacing: 0.05em;
            text-transform: uppercase;
            margin-bottom: 12px;
        }

        .page-title h1 {
            font-size: 2rem;
            font-weight: 800;
            color: #0f172a;
            letter-spacing: -0.03em;
            margin-bottom: 8px;
        }

        .page-title p { color: #94a3b8; font-size: 0.9rem; }

        /* ── Card ── */
        .form-card {
            background: #fff;
            border-radius: 20px;
            box-shadow: 0 4px 24px rgba(0,0,0,0.07);
            overflow: hidden;
        }

        .card-section {
            padding: 32px 40px;
            border-bottom: 1px solid #f1f5f9;
        }

        .card-section:last-child { border-bottom: none; }

        .section-label {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 24px;
        }

        .section-label .num {
            width: 28px; height: 28px;
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            border-radius: 8px;
            display: flex; align-items: center; justify-content: center;
            color: #fff;
            font-size: 0.75rem;
            font-weight: 800;
            flex-shrink: 0;
        }

        .section-label span {
            font-size: 0.8rem;
            font-weight: 700;
            color: #475569;
            text-transform: uppercase;
            letter-spacing: 0.08em;
        }

        .field-row { display: grid; gap: 16px; }
        .field-row.cols-2 { grid-template-columns: 1fr 1fr; }

        .field-group { display: flex; flex-direction: column; }

        .field-label {
            font-size: 0.8rem;
            font-weight: 600;
            color: #475569;
            margin-bottom: 8px;
            letter-spacing: 0.02em;
        }

        .input-wrap { position: relative; }

        .input-wrap .icon {
            position: absolute;
            left: 14px; top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            font-size: 0.95rem;
            pointer-events: none;
        }

        .input-wrap input,
        .input-wrap select {
            width: 100%;
            padding: 12px 14px 12px 40px;
            border: 1.5px solid #e2e8f0;
            border-radius: 10px;
            font-size: 0.88rem;
            font-family: inherit;
            color: #0f172a;
            background: #f8fafc;
            transition: all 0.2s;
            outline: none;
            appearance: none;
        }

        .input-wrap input:focus,
        .input-wrap select:focus {
            border-color: #6366f1;
            background: #fff;
            box-shadow: 0 0 0 3px rgba(99,102,241,0.1);
        }

        /* Role selector */
        .role-selector {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 10px;
        }

        .role-opt {
            position: relative;
        }

        .role-opt input[type="radio"] {
            position: absolute;
            opacity: 0;
            width: 0; height: 0;
        }

        .role-opt label {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 6px;
            padding: 14px 8px;
            border: 1.5px solid #e2e8f0;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.2s;
            background: #f8fafc;
            font-size: 0.78rem;
            font-weight: 600;
            color: #64748b;
            text-align: center;
        }

        .role-opt label i { font-size: 1.3rem; }

        .role-opt input:checked + label {
            border-color: #6366f1;
            background: rgba(99,102,241,0.06);
            color: #6366f1;
            box-shadow: 0 0 0 3px rgba(99,102,241,0.1);
        }

        .role-opt.admin input:checked + label   { border-color: #dc2626; background: rgba(220,38,38,0.05);  color: #dc2626; box-shadow: 0 0 0 3px rgba(220,38,38,0.1); }
        .role-opt.teacher input:checked + label { border-color: #16a34a; background: rgba(22,163,74,0.05);  color: #16a34a; box-shadow: 0 0 0 3px rgba(22,163,74,0.1); }
        .role-opt.student input:checked + label { border-color: #2563eb; background: rgba(37,99,235,0.05);  color: #2563eb; box-shadow: 0 0 0 3px rgba(37,99,235,0.1); }
        .role-opt.coordinator input:checked + label { border-color: #d97706; background: rgba(217,119,6,0.05); color: #d97706; box-shadow: 0 0 0 3px rgba(217,119,6,0.1); }

        .role-opt label:hover {
            border-color: #94a3b8;
            background: #fff;
        }

        /* Verify box */
        .verify-box {
            background: #f8fafc;
            border: 1.5px solid #e2e8f0;
            border-radius: 12px;
            padding: 16px 20px;
            display: none;
        }

        .verify-box.show { display: block; }

        .verify-box .verify-title {
            font-size: 0.78rem;
            font-weight: 700;
            color: #475569;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .verify-box input {
            width: 100%;
            padding: 11px 14px;
            border: 1.5px solid #e2e8f0;
            border-radius: 8px;
            font-size: 0.88rem;
            font-family: inherit;
            background: #fff;
            outline: none;
            transition: all 0.2s;
        }

        .verify-box input:focus {
            border-color: #6366f1;
            box-shadow: 0 0 0 3px rgba(99,102,241,0.1);
        }

        .verify-hint {
            font-size: 0.75rem;
            color: #94a3b8;
            margin-top: 6px;
        }

        /* Submit */
        .card-footer-section {
            padding: 24px 40px;
            background: #f8fafc;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
        }

        .btn-register {
            padding: 13px 32px;
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            border: none;
            border-radius: 10px;
            color: #fff;
            font-size: 0.9rem;
            font-weight: 700;
            font-family: inherit;
            cursor: pointer;
            transition: all 0.25s;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 24px rgba(99,102,241,0.4);
        }

        .footer-note {
            font-size: 0.82rem;
            color: #94a3b8;
        }

        .footer-note a {
            color: #6366f1;
            font-weight: 700;
            text-decoration: none;
        }

        .alert-box {
            padding: 12px 16px;
            border-radius: 10px;
            font-size: 0.85rem;
            margin: 0 40px 0;
            display: flex;
            align-items: flex-start;
            gap: 10px;
        }

        .alert-box.error   { background: #fef2f2; color: #b91c1c; border: 1px solid #fecaca; }

        @media (max-width: 640px) {
            .card-section { padding: 24px 20px; }
            .card-footer-section { padding: 20px; flex-direction: column; }
            .role-selector { grid-template-columns: repeat(2, 1fr); }
            .field-row.cols-2 { grid-template-columns: 1fr; }
            .top-banner { padding: 16px 20px; }
        }
    </style>
</head>
<body>

<!-- Top Banner -->
<div class="top-banner">
    <a href="<?= base_url('/') ?>" class="banner-logo">
        <div class="icon-box"><i class="bi bi-shield-check"></i></div>
        <span>RBAC</span>
    </a>
    <div class="banner-right">
        Already have an account? <a href="<?= base_url('/') ?>">Sign in</a>
    </div>
</div>

<!-- Page Body -->
<div class="page-body">
    <div class="register-container">

        <div class="page-title">
            <div class="badge-tag"><i class="bi bi-person-plus"></i> New Account</div>
            <h1>Create your account</h1>
            <p>Fill in the details below to register and get access to the system</p>
        </div>

        <?php if (session()->getFlashdata('notif_error')): ?>
            <div class="alert-box error mb-3">
                <i class="bi bi-exclamation-circle-fill" style="margin-top:1px;flex-shrink:0;"></i>
                <span><?= session()->getFlashdata('notif_error') ?></span>
            </div>
        <?php endif; ?>

        <div class="form-card">
            <form action="<?= base_url('register') ?>" method="POST">

                <!-- Section 1: Personal Info -->
                <div class="card-section">
                    <div class="section-label">
                        <div class="num">1</div>
                        <span>Personal Information</span>
                    </div>
                    <div class="field-row cols-2">
                        <div class="field-group">
                            <label class="field-label">Full Name</label>
                            <div class="input-wrap">
                                <i class="bi bi-person icon"></i>
                                <input type="text" name="inputFullname" placeholder="Juan dela Cruz" value="<?= old('inputFullname') ?>" required>
                            </div>
                        </div>
                        <div class="field-group">
                            <label class="field-label">Email Address</label>
                            <div class="input-wrap">
                                <i class="bi bi-envelope icon"></i>
                                <input type="email" name="inputEmail" id="inputEmail" placeholder="Select a role first" value="<?= old('inputEmail') ?>" required>
                            </div>
                            <div id="emailHint" class="verify-hint"></div>
                        </div>
                    </div>
                </div>

                <!-- Section 2: Role -->
                <div class="card-section">
                    <div class="section-label">
                        <div class="num">2</div>
                        <span>Select Your Role</span>
                    </div>
                    <div class="role-selector">
                        <div class="role-opt admin">
                            <input type="radio" name="inputRole" id="role_admin" value="admin" <?= old('inputRole') === 'admin' ? 'checked' : '' ?>>
                            <label for="role_admin"><i class="bi bi-shield-fill"></i> Admin</label>
                        </div>
                        <div class="role-opt teacher">
                            <input type="radio" name="inputRole" id="role_teacher" value="teacher" <?= old('inputRole') === 'teacher' ? 'checked' : '' ?>>
                            <label for="role_teacher"><i class="bi bi-person-workspace"></i> Teacher</label>
                        </div>
                        <div class="role-opt coordinator">
                            <input type="radio" name="inputRole" id="role_coordinator" value="coordinator" <?= old('inputRole') === 'coordinator' ? 'checked' : '' ?>>
                            <label for="role_coordinator"><i class="bi bi-diagram-3-fill"></i> Coordinator</label>
                        </div>
                        <div class="role-opt student">
                            <input type="radio" name="inputRole" id="role_student" value="student" <?= old('inputRole') === 'student' ? 'checked' : '' ?>>
                            <label for="role_student"><i class="bi bi-mortarboard-fill"></i> Student</label>
                        </div>
                    </div>

                    <!-- Verification -->
                    <div class="verify-box mt-3" id="verifyBox">
                        <div class="verify-title"><i class="bi bi-key-fill"></i> <span id="verifyLabel">Verification</span></div>
                        <input type="text" name="inputVerify" id="inputVerify" placeholder="" value="<?= old('inputVerify') ?>">
                        <div class="verify-hint" id="verifyHint"></div>
                    </div>
                </div>

                <!-- Section 3: Password -->
                <div class="card-section">
                    <div class="section-label">
                        <div class="num">3</div>
                        <span>Set Password</span>
                    </div>
                    <div class="field-row cols-2">
                        <div class="field-group">
                            <label class="field-label">Password</label>
                            <div class="input-wrap">
                                <i class="bi bi-lock icon"></i>
                                <input type="password" name="inputPassword" placeholder="Min. 6 characters" required>
                            </div>
                        </div>
                        <div class="field-group">
                            <label class="field-label">Confirm Password</label>
                            <div class="input-wrap">
                                <i class="bi bi-lock-fill icon"></i>
                                <input type="password" name="inputPassword2" placeholder="Repeat password" required>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Footer -->
                <div class="card-footer-section">
                    <p class="footer-note">Already registered? <a href="<?= base_url('/') ?>">Sign in here</a></p>
                    <button type="submit" class="btn-register">
                        <i class="bi bi-person-check-fill"></i> Create Account
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

<script>
const roleConfig = {
    admin:       { emailPlaceholder: 'admin@school.edu.ph',       emailHint: 'Use your admin institutional email (@school.edu.ph).',       verifyLabel: 'Admin Secret Code',      verifyHint: 'Enter the admin registration code.',          verifyPlaceholder: 'e.g. ADMIN@JURADO2024' },
    teacher:     { emailPlaceholder: 'teacher@school.edu.ph',     emailHint: 'Use your teacher institutional email (@school.edu.ph).',     verifyLabel: 'Teacher ID Number',      verifyHint: 'Enter your assigned teacher ID.',             verifyPlaceholder: 'e.g. TCH-001' },
    coordinator: { emailPlaceholder: 'coordinator@school.edu.ph', emailHint: 'Use your coordinator institutional email (@school.edu.ph).', verifyLabel: 'Coordinator Code',       verifyHint: 'Enter the coordinator registration code.',    verifyPlaceholder: 'e.g. COORD@JURADO2024' },
    student:     { emailPlaceholder: 'student@school.edu.ph',     emailHint: 'Use your student institutional email (@school.edu.ph).',     verifyLabel: 'Student ID Number',      verifyHint: 'Enter your 9-digit student ID.',              verifyPlaceholder: 'e.g. 423001937' },
};

const radios     = document.querySelectorAll('input[name="inputRole"]');
const verifyBox  = document.getElementById('verifyBox');
const verifyLabel= document.getElementById('verifyLabel');
const verifyInput= document.getElementById('inputVerify');
const verifyHint = document.getElementById('verifyHint');
const emailInput = document.getElementById('inputEmail');
const emailHint  = document.getElementById('emailHint');

function applyRole(val) {
    const c = roleConfig[val];
    if (!c) { verifyBox.classList.remove('show'); return; }
    emailInput.placeholder  = c.emailPlaceholder;
    emailHint.textContent   = c.emailHint;
    verifyLabel.textContent = c.verifyLabel;
    verifyInput.placeholder = c.verifyPlaceholder;
    verifyHint.textContent  = c.verifyHint;
    verifyBox.classList.add('show');
    verifyInput.required = true;
}

radios.forEach(r => r.addEventListener('change', () => applyRole(r.value)));

// Re-apply on load if old() value exists
const checked = document.querySelector('input[name="inputRole"]:checked');
if (checked) applyRole(checked.value);
</script>
</body>
</html>
