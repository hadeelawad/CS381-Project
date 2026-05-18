<?php
session_start();
require 'includes/functions.php';

// لو سجلت دخول مسبقاً، وجهها مباشرة
if (isset($_SESSION['user_role'])) {
    if ($_SESSION['user_role'] === 'admin') {
        header("Location: admin/dashboard.php");
    } else {
        header("Location: student/dashboard.php");
    }
    exit();
}

// رسائل الخطأ
$error = '';
if (isset($_GET['error'])) {
    if ($_GET['error'] === 'invalid') $error = 'Invalid email or password.';
    if ($_GET['error'] === 'exists')  $error = 'This email is already registered.';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>YIC IT Support — Login</title>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet"/>

  <!-- Shared styles -->
  <link rel="stylesheet" href="css/style.css"/>

  <!-- Login-specific styles only -->
  <style>
    /* Split layout — only needed on login page */
    .split { display: flex; width: 100%; min-height: 100vh; align-items: stretch; }

    /* LEFT PANEL */
    .left {
      width: 42%;
      background: var(--dark-bg);
      position: relative;
      display: flex;
      flex-direction: column;
      justify-content: flex-end;
      padding: 48px 44px;
      overflow: hidden;
    }

    /* Glowing background blobs */
    .blob { position: absolute; border-radius: 50%; pointer-events: none; }
    .blob-1 { width: 380px; height: 380px; background: #6d28d9; filter: blur(100px); opacity: 0.45; top: -100px; left: -100px; }
    .blob-2 { width: 280px; height: 280px; background: #0891b2; filter: blur(80px);  opacity: 0.30; bottom: 40px; right: -60px; }
    .blob-3 { width: 200px; height: 200px; background: #db2777; filter: blur(70px);  opacity: 0.22; top: 42%; left: 32%; }

    .left-content { position: relative; z-index: 2; }

    .badge {
      display: inline-flex; align-items: center; gap: 7px;
      background: var(--purple-dim); border: 1px solid var(--purple-bdr);
      color: #c4b5fd; font-size: 12px; font-weight: 600;
      padding: 5px 13px; border-radius: 30px; margin-bottom: 22px;
    }
    .badge-dot { width: 6px; height: 6px; background: #a78bfa; border-radius: 50%; }

    .left-title { font-size: 36px; font-weight: 700; color: var(--white); line-height: 1.2; margin-bottom: 14px; }
    .left-title span { color: #a78bfa; }
    .left-sub { font-size: 14px; color: rgba(255,255,255,0.42); line-height: 1.8; margin-bottom: 32px; }

    .pills { display: flex; flex-direction: column; gap: 10px; }
    .pill {
      display: flex; align-items: center; gap: 12px;
      background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.07);
      border-radius: 13px; padding: 11px 15px; transition: background 0.2s;
    }
    .pill:hover { background: rgba(255,255,255,0.07); }
    .pill-icon { width: 34px; height: 34px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 15px; flex-shrink: 0; }
    .pill-icon.p { background: rgba(139,92,246,0.22); }
    .pill-icon.c { background: rgba(6,182,212,0.20); }
    .pill-icon.k { background: rgba(236,72,153,0.20); }
    .pill-text { font-size: 13px; font-weight: 600; color: rgba(255,255,255,0.72); }
    .pill-sub  { font-size: 11px; color: rgba(255,255,255,0.30); margin-top: 2px; }

    /* RIGHT PANEL */
    .right {
      flex: 1; background: var(--dark-card);
      position: relative; display: flex;
      align-items: center; justify-content: center;
      padding: 40px 24px; overflow: visible;
    }
    .blob-4 { width: 320px; height: 320px; background: #4f46e5; filter: blur(110px); opacity: 0.18; top: -80px; right: -80px; }
    .blob-5 { width: 240px; height: 240px; background: #0e7490; filter: blur(90px);  opacity: 0.14; bottom: -60px; left: -40px; }

    /* GLASS CARD */
    .glass-card {
      position: relative; z-index: 2;
      width: 100%; max-width: 400px;
      background: var(--glass-bg); border: 1px solid var(--glass-bdr);
      border-radius: 22px; padding: 36px 32px;
      backdrop-filter: blur(18px); -webkit-backdrop-filter: blur(18px);
    }

    .logo-row { display: flex; align-items: center; gap: 13px; margin-bottom: 28px; }
    .logo-icon {
      width: 42px; height: 42px;
      background: linear-gradient(135deg, var(--purple), var(--cyan));
      border-radius: 13px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;
    }
    .logo-icon svg { width: 21px; height: 21px; }
    .logo-name    { font-size: 15px; font-weight: 700; color: var(--white); line-height: 1.15; }
    .logo-college { font-size: 11px; color: var(--muted); }

    /* Tabs */
    .tabs { display: flex; background: rgba(255,255,255,0.06); border-radius: 11px; padding: 4px; margin-bottom: 24px; }
    .tab-btn {
      flex: 1; padding: 8px; border: none; background: transparent;
      border-radius: 8px; font-family: var(--font); font-size: 13px;
      font-weight: 600; color: var(--muted); cursor: pointer; transition: all 0.2s;
    }
    .tab-btn.active { background: rgba(139,92,246,0.28); color: #e9d5ff; }

    .form-panel { display: none; }
    .form-panel.active { display: block; animation: fadeIn 0.22s ease both; }
    @keyframes fadeIn { from { opacity: 0; transform: translateY(6px); } to { opacity: 1; transform: translateY(0); } }

    .form-title { font-size: 20px; font-weight: 700; color: var(--white); margin-bottom: 4px; }
    .form-sub   { font-size: 13px; color: var(--muted); margin-bottom: 22px; }

    /* Role selector */
    .role-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 10px; margin-bottom: 16px; }
    .role-label-wrap { cursor: pointer; }
    .role-label-wrap input { display: none; }
    .role-card {
      border: 1px solid rgba(255,255,255,0.10); border-radius: var(--radius);
      padding: 12px 10px; text-align: center; transition: all 0.2s;
      background: rgba(255,255,255,0.04);
    }
    .role-card:hover { border-color: rgba(139,92,246,0.4); }
    .role-label-wrap input:checked + .role-card { border-color: var(--purple); background: rgba(139,92,246,0.14); }
    .role-emoji { font-size: 20px; margin-bottom: 5px; }
    .role-name  { font-size: 12px; font-weight: 600; color: rgba(255,255,255,0.72); }

    /* Submit button */
    .btn-submit {
      width: 100%; padding: 13px;
      background: linear-gradient(135deg, var(--purple), var(--cyan));
      color: var(--white); border: none; border-radius: var(--radius);
      font-family: var(--font); font-size: 14px; font-weight: 700;
      cursor: pointer; margin-top: 6px;
      display: flex; align-items: center; justify-content: center; gap: 8px;
      transition: opacity 0.2s, transform 0.1s;
    }
    .btn-submit:hover  { opacity: 0.88; }
    .btn-submit:active { transform: scale(0.98); }
    .btn-submit svg { width: 16px; height: 16px; }

    .footer-note { text-align: center; font-size: 11px; color: rgba(255,255,255,0.2); margin-top: 20px; }

    @media (max-width: 768px) {
      .left { display: none; }
      .right { padding: 32px 20px; }
      .glass-card { padding: 28px 22px; }
    }
  </style>
</head>
<body>

<div class="split">

  <!-- LEFT PANEL -->
  <div class="left">
    <div class="blob blob-1"></div>
    <div class="blob blob-2"></div>
    <div class="blob blob-3"></div>
    <div class="left-content">
      <div class="badge"><div class="badge-dot"></div>YIC Service Portal</div>
      <h1 class="left-title">One place for<br>every <span>IT issue.</span></h1>
      <p class="left-sub">Report problems, track progress,<br>and get back to studying — fast.</p>
      <div class="pills">
        <div class="pill">
          <div class="pill-icon p">🎫</div>
          <div><div class="pill-text">Submit a ticket instantly</div><div class="pill-sub">Describe your issue in seconds</div></div>
        </div>
        <div class="pill">
          <div class="pill-icon c">📡</div>
          <div><div class="pill-text">Track in real time</div><div class="pill-sub">See status updates as they happen</div></div>
        </div>
        <div class="pill">
          <div class="pill-icon k">🔒</div>
          <div><div class="pill-text">Secure &amp; private</div><div class="pill-sub">Your data stays yours</div></div>
        </div>
      </div>
    </div>
  </div>

  <!-- RIGHT PANEL -->
  <div class="right">
    <div class="blob blob-4"></div>
    <div class="blob blob-5"></div>
    <div class="glass-card">

      <div class="logo-row">
        <div class="logo-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M3 18v-6a9 9 0 0 1 18 0v6"/>
            <path d="M21 19a2 2 0 0 1-2 2h-1a2 2 0 0 1-2-2v-3a2 2 0 0 1 2-2h3z"/>
            <path d="M3 19a2 2 0 0 0 2 2h1a2 2 0 0 0 2-2v-3a2 2 0 0 0-2-2H3z"/>
          </svg>
        </div>
        <div>
          <div class="logo-name">YIC IT Support</div>
          <div class="logo-college">Yanbu Industrial College</div>
        </div>
      </div>

      <div class="tabs">
        <button class="tab-btn active" onclick="switchTab('login')">Login</button>
        <button class="tab-btn"        onclick="switchTab('register')">Register</button>
      </div>
      <?php if ($error): ?>
  <div class="msg error"><?php echo $error; ?></div>
        <?php endif; ?>

      <!-- LOGIN FORM -->
      <div class="form-panel active" id="panel-login">
        <p class="form-title">Welcome back</p>
        <p class="form-sub">Sign in to your account</p>
        <div class="msg" id="login-msg"></div>
        <form action="includes/auth.php" method="POST" onsubmit="return validateLogin()">
          <input type="hidden" name="action" value="login"/>
          <input type="hidden" name="csrf_token" value="<?php echo generateCSRF(); ?>"/>
          <div class="field">
            <label>Email address</label>
            <input type="email" id="login-email" name="email" placeholder="you@yic.edu.sa" required/>
          </div>
          <div class="field">
            <label>Password</label>
            <input type="password" id="login-pass" name="password" placeholder="Enter your password" required/>
          </div>
          <button type="submit" class="btn-submit">
            Sign in
            <svg viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
          </button>
        </form>
      </div>

      <!-- REGISTER FORM -->
      <div class="form-panel" id="panel-register">
        <p class="form-title">Create account</p>
        <p class="form-sub">Join the IT support portal</p>
        <div class="msg" id="register-msg"></div>
        <form action="includes/auth.php" method="POST" onsubmit="return validateRegister()">
          <input type="hidden" name="action" value="register"/>
          <input type="hidden" name="csrf_token" value="<?php echo generateCSRF(); ?>"/>
          <div class="field">
            <label>Full name</label>
            <input type="text" id="reg-name" name="name" placeholder="Your full name" required/>
          </div>
          <div class="field">
            <label>Email address</label>
            <input type="email" id="reg-email" name="email" placeholder="you@yic.edu.sa" required/>
          </div>
          <div class="field">
            <label>Password</label>
            <input type="password" id="reg-pass" name="password" placeholder="Min. 6 characters" required/>
          </div>
          <div class="field">
            <label>Confirm password</label>
            <input type="password" id="reg-pass2" name="confirm_password" placeholder="Repeat password" required/>
          </div>
          <div class="field">
            <label>I am a</label>
            <div class="role-grid">
              <label class="role-label-wrap">
                <input type="radio" name="role" value="student" checked/>
                <div class="role-card"><div class="role-emoji">🎓</div><div class="role-name">Student</div></div>
              </label>
              <label class="role-label-wrap">
                <input type="radio" name="role" value="admin"/>
                <div class="role-card"><div class="role-emoji">🛠️</div><div class="role-name">Admin</div></div>
              </label>
            </div>
          </div>
          <button type="submit" class="btn-submit">
            Create account
            <svg viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
          </button>
        </form>
      </div>

      <p class="footer-note">YIC IT Support Portal &mdash; 2025&ndash;2026</p>
    </div>
  </div>
</div>

<script>
  function switchTab(tab) {
    document.querySelectorAll('.tab-btn').forEach((btn, i) => {
      btn.classList.toggle('active', (tab === 'login' && i === 0) || (tab === 'register' && i === 1));
    });
    document.getElementById('panel-login').classList.toggle('active', tab === 'login');
    document.getElementById('panel-register').classList.toggle('active', tab === 'register');
  }

  function showMsg(id, text, type) {
    const el = document.getElementById(id);
    el.textContent = text;
    el.className = 'msg ' + type;
  }

  function validateLogin() {
    const email = document.getElementById('login-email').value.trim();
    const pass  = document.getElementById('login-pass').value;
    if (!email || !pass) { showMsg('login-msg', 'Please fill in all fields.', 'error'); return false; }
    return true;
  }

  function validateRegister() {
    const name  = document.getElementById('reg-name').value.trim();
    const email = document.getElementById('reg-email').value.trim();
    const pass  = document.getElementById('reg-pass').value;
    const pass2 = document.getElementById('reg-pass2').value;
    if (!name || !email || !pass || !pass2) { showMsg('register-msg', 'Please fill in all fields.', 'error'); return false; }
    if (pass.length < 6) { showMsg('register-msg', 'Password must be at least 6 characters.', 'error'); return false; }
    if (pass !== pass2) { showMsg('register-msg', 'Passwords do not match.', 'error'); return false; }
    return true;
  }
</script>

</body>
</html>