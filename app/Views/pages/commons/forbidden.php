<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div style="display:flex;flex-direction:column;align-items:center;justify-content:center;min-height:60vh;text-align:center;gap:16px;">
    <div style="width:72px;height:72px;border-radius:50%;background:#fdf2f1;border:2px solid #f5c6c2;display:flex;align-items:center;justify-content:center;">
        <i class="bi bi-lock-fill" style="font-size:2rem;color:#c0392b;"></i>
    </div>
    <div>
        <div style="font-size:3rem;font-weight:800;color:#1a1916;letter-spacing:-0.04em;line-height:1;">403</div>
        <div style="font-size:1.1rem;font-weight:700;color:#1a1916;margin-top:4px;">Access Forbidden</div>
        <div style="font-size:0.875rem;color:#9c9a94;margin-top:8px;">You don't have permission to access this page.</div>
    </div>
    <a href="javascript:history.back()" style="margin-top:8px;display:inline-flex;align-items:center;gap:8px;padding:10px 24px;border-radius:10px;background:#f5f4f0;color:#1a1916;font-size:0.875rem;font-weight:600;text-decoration:none;border:1px solid #e8e6e0;"
       onmouseover="this.style.background='#e8e6e0'" onmouseout="this.style.background='#f5f4f0'">
        <i class="bi bi-arrow-left"></i> Go Back
    </a>
</div>

<?= $this->endSection() ?>
