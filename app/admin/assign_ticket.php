<?php
// ============================================================
// admin/assign_ticket.php — Phase 2 Frontend
// Path: Project_CS381/app/admin/assign_ticket.php
// ============================================================

$admin_name     = "Admin Support";
$admin_initials = "AS";

// Dummy ticket — replaced with DB query in Phase 3
$ticket = [
  "id"          => 2,
  "title"       => "Projector not working in Lab 3",
  "student"     => "Sara Mohammed",
  "category"    => "Hardware",
  "priority"    => "High",
  "location"    => "Lab 3, Building A",
  "description" => "The projector in Lab 3 has not been working since Monday. When I press the power button, the light blinks orange but nothing shows on screen.",
  "status"      => "progress",
  "date"        => "Apr 08, 2026",
];

// Dummy technicians list — replaced with DB query in Phase 3
$technicians = [
  ["id" => 1, "name" => "Khalid Al-Rashidi"],
  ["id" => 2, "name" => "Omar Faisal"],
  ["id" => 3, "name" => "Tariq Nasser"],
];

// Dummy response thread
$responses = [
  [
    "sender"   => "Sara Mohammed",
    "initials" => "SM",
    "role"     => "student",
    "message"  => "The projector in Lab 3 has not been working since Monday. Pressing power gives an orange blinking light but no display.",
    "time"     => "Apr 08, 2026 — 10:14 AM",
  ],
  [
    "sender"   => "Admin Support",
    "initials" => "AS",
    "role"     => "admin",
    "message"  => "Thank you for reporting this. We have assigned a technician to look into it.",
    "time"     => "Apr 08, 2026 — 11:30 AM",
  ],
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>YIC IT Support — Manage Ticket</title>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet"/>
  <link rel="stylesheet" href="../css/style.css"/>
  <style>
    /* Two column layout for this page */
    .two-col {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 20px;
      align-items: start;
    }

    /* Ticket info card */
    .ticket-info {
      background: var(--glass-bg);
      border: 1px solid var(--glass-bdr);
      border-radius: var(--radius-lg);
      padding: 22px 24px;
      backdrop-filter: blur(12px);
      margin-bottom: 20px;
    }
    .ticket-info-header {
      display: flex;
      align-items: flex-start;
      justify-content: space-between;
      margin-bottom: 14px;
      gap: 12px;
    }
    .ticket-info-title { font-size: 16px; font-weight: 700; color: var(--white); }
    .ticket-meta { display: flex; flex-wrap: wrap; gap: 8px; margin-bottom: 14px; }
    .meta-pill {
      display: inline-flex; align-items: center; gap: 5px;
      background: rgba(255,255,255,0.06); border: 1px solid var(--glass-bdr);
      border-radius: 20px; padding: 3px 10px;
      font-size: 11px; font-weight: 600; color: var(--muted);
    }
    .meta-pill svg { width: 11px; height: 11px; }
    .ticket-description {
      font-size: 13px; color: rgba(255,255,255,0.60);
      line-height: 1.7; padding-top: 14px;
      border-top: 1px solid var(--glass-bdr);
    }

    /* Thread */
    .thread-section {
      background: var(--glass-bg);
      border: 1px solid var(--glass-bdr);
      border-radius: var(--radius-lg);
      overflow: hidden;
      backdrop-filter: blur(12px);
    }
    .thread-section-header {
      padding: 14px 20px;
      border-bottom: 1px solid var(--glass-bdr);
      font-size: 13px; font-weight: 700; color: var(--white);
    }
    .thread-body { padding: 18px 20px; }

    /* Reply box */
    .reply-box {
      background: var(--glass-bg);
      border: 1px solid var(--glass-bdr);
      border-radius: var(--radius-lg);
      padding: 18px 20px;
      backdrop-filter: blur(12px);
      margin-top: 16px;
    }
    .reply-box-title { font-size: 13px; font-weight: 700; color: var(--white); margin-bottom: 10px; }
    .reply-row { display: flex; gap: 10px; align-items: flex-end; }
    .reply-row textarea {
      flex: 1; padding: 10px 13px;
      background: rgba(255,255,255,0.06);
      border: 1px solid var(--glass-bdr);
      border-radius: var(--radius);
      font-family: var(--font); font-size: 13px; color: var(--white);
      outline: none; resize: none; min-height: 56px; line-height: 1.6;
      transition: border-color 0.2s, background 0.2s;
    }
    .reply-row textarea:focus { border-color: rgba(139,92,246,0.55); background: rgba(139,92,246,0.08); }
    .reply-row textarea::placeholder { color: var(--dimmer); }

    @media (max-width: 900px) {
      .two-col { grid-template-columns: 1fr; }
    }
  </style>
</head>
<body>

<div class="layout">

  <!-- ============================================================
       SIDEBAR
  ============================================================ -->
  <aside class="sidebar">
    <div class="sidebar-logo">
      <div class="sidebar-logo-icon">
        <svg viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M3 18v-6a9 9 0 0 1 18 0v6"/>
          <path d="M21 19a2 2 0 0 1-2 2h-1a2 2 0 0 1-2-2v-3a2 2 0 0 1 2-2h3z"/>
          <path d="M3 19a2 2 0 0 0 2 2h1a2 2 0 0 0 2-2v-3a2 2 0 0 0-2-2H3z"/>
        </svg>
      </div>
      <div>
        <div class="sidebar-logo-name">YIC IT Support</div>
        <div class="sidebar-logo-college">Yanbu Industrial College</div>
      </div>
    </div>

    <nav>
      <a href="dashboard.php" class="nav-item">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/>
          <rect x="3" y="14" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/>
        </svg>
        All Tickets
      </a>
      <a href="assign_ticket.php" class="nav-item active">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
          <circle cx="9" cy="7" r="4"/>
          <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
          <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
        </svg>
        Assign Ticket
      </a>
    </nav>

    <div class="sidebar-bottom">
      <div class="user-info">
        <div class="user-avatar" style="background:rgba(6,182,212,0.15);color:#67e8f9;border-color:rgba(6,182,212,0.3);">
          <?php echo $admin_initials; ?>
        </div>
        <div>
          <div class="user-name"><?php echo $admin_name; ?></div>
          <div class="user-role">Administrator</div>
        </div>
      </div>
      <a href="../logout.php">
        <button class="btn-logout">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
            <polyline points="16 17 21 12 16 7"/>
            <line x1="21" y1="12" x2="9" y2="12"/>
          </svg>
          Logout
        </button>
      </a>
    </div>
  </aside>

  <!-- ============================================================
       MAIN CONTENT
  ============================================================ -->
  <main class="main">

    <div class="page-header">
      <div>
        <h1 class="page-title">Manage Ticket #<?php echo $ticket['id']; ?></h1>
        <p class="page-subtitle">Assign, update status, and respond</p>
      </div>
      <a href="dashboard.php">
        <button class="btn btn-ghost">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M19 12H5M12 19l-7-7 7-7"/>
          </svg>
          Back
        </button>
      </a>
    </div>

    <div class="two-col">

      <!-- LEFT COLUMN: ticket info + conversation -->
      <div>

        <!-- Ticket info -->
        <div class="ticket-info">
          <div class="ticket-info-header">
            <h2 class="ticket-info-title"><?php echo htmlspecialchars($ticket['title']); ?></h2>
            <?php if ($ticket['status']==='open'): ?>
              <span class="badge-status badge-open">Open</span>
            <?php elseif ($ticket['status']==='progress'): ?>
              <span class="badge-status badge-progress">In Progress</span>
            <?php else: ?>
              <span class="badge-status badge-resolved">Resolved</span>
            <?php endif; ?>
          </div>
          <div class="ticket-meta">
            <span class="meta-pill">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
              <?php echo $ticket['student']; ?>
            </span>
            <span class="meta-pill">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 6h16M4 12h16M4 18h7"/></svg>
              <?php echo $ticket['category']; ?>
            </span>
            <span class="meta-pill">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
              <?php echo $ticket['location']; ?>
            </span>
            <span class="meta-pill" style="color:<?php echo $ticket['priority']==='High'?'var(--status-open)':'var(--muted)'; ?>">
              <?php echo $ticket['priority']; ?> Priority
            </span>
          </div>
          <p class="ticket-description"><?php echo htmlspecialchars($ticket['description']); ?></p>
        </div>

        <!-- Conversation thread -->
        <div class="thread-section">
          <div class="thread-section-header">Conversation</div>
          <div class="thread-body">
            <div class="thread">
              <?php foreach ($responses as $r): ?>
              <div class="thread-msg <?php echo $r['role']==='admin' ? 'admin-msg' : ''; ?>">
                <div class="thread-avatar <?php echo $r['role']; ?>"><?php echo $r['initials']; ?></div>
                <div class="thread-bubble">
                  <div class="thread-name"><?php echo $r['sender']; ?></div>
                  <div class="thread-text"><?php echo htmlspecialchars($r['message']); ?></div>
                  <div class="thread-time"><?php echo $r['time']; ?></div>
                </div>
              </div>
              <?php endforeach; ?>
            </div>
          </div>
        </div>

        <!-- Admin reply box -->
        <div class="reply-box">
          <p class="reply-box-title">Reply to student</p>
          <form action="../includes/tickets.php" method="POST" onsubmit="return validateReply()">
            <input type="hidden" name="action"    value="reply"/>
            <input type="hidden" name="ticket_id" value="<?php echo $ticket['id']; ?>"/>
            <div class="reply-row">
              <textarea id="reply-text" name="message" placeholder="Type your response..." required></textarea>
              <button type="submit" class="btn btn-primary" style="padding:12px 16px;align-self:flex-end;">
                <svg viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                  <line x1="22" y1="2" x2="11" y2="13"/>
                  <polygon points="22 2 15 22 11 13 2 9 22 2"/>
                </svg>
                Send
              </button>
            </div>
            <div class="msg" id="reply-msg" style="margin-top:10px;"></div>
          </form>
        </div>

      </div>

      <!-- RIGHT COLUMN: assign + update status -->
      <div>

        <!-- Assign technician -->
        <div class="form-card" style="margin-bottom:16px;">
          <p style="font-size:15px;font-weight:700;color:var(--white);margin-bottom:18px;">Assign Technician</p>
          <form action="../includes/tickets.php" method="POST">
            <input type="hidden" name="action"    value="assign"/>
            <input type="hidden" name="ticket_id" value="<?php echo $ticket['id']; ?>"/>
            <div class="field">
              <label>Select technician</label>
              <select name="technician_id" required>
                <option value="" disabled selected>Choose a technician</option>
                <?php foreach ($technicians as $tech): ?>
                  <option value="<?php echo $tech['id']; ?>"><?php echo $tech['name']; ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <button type="submit" class="btn btn-primary" style="width:100%;justify-content:center;padding:11px;">
              <svg viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                <circle cx="9" cy="7" r="4"/>
                <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
                <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
              </svg>
              Assign
            </button>
          </form>
        </div>

        <!-- Update status -->
        <div class="form-card">
          <p style="font-size:15px;font-weight:700;color:var(--white);margin-bottom:18px;">Update Status</p>
          <form action="../includes/tickets.php" method="POST">
            <input type="hidden" name="action"    value="update_status"/>
            <input type="hidden" name="ticket_id" value="<?php echo $ticket['id']; ?>"/>
            <div class="field">
              <label>New status</label>
              <select name="status" required>
                <option value="open"     <?php echo $ticket['status']==='open'     ? 'selected':''; ?>>Open</option>
                <option value="progress" <?php echo $ticket['status']==='progress' ? 'selected':''; ?>>In Progress</option>
                <option value="resolved" <?php echo $ticket['status']==='resolved' ? 'selected':''; ?>>Resolved</option>
              </select>
            </div>
            <div class="field">
              <label>Note <span style="color:var(--muted);font-size:10px;text-transform:none;letter-spacing:0;">(optional)</span></label>
              <textarea name="note" placeholder="Add a note about this status change..." style="min-height:80px;"></textarea>
            </div>
            <button type="submit" class="btn btn-primary" style="width:100%;justify-content:center;padding:11px;">
              <svg viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="20 6 9 17 4 12"/>
              </svg>
              Update Status
            </button>
          </form>
        </div>

      </div>
    </div>

  </main>
</div>

<script>
  function validateReply() {
    const text = document.getElementById('reply-text').value.trim();
    const msg  = document.getElementById('reply-msg');
    if (!text) {
      msg.textContent = 'Please write a message before sending.';
      msg.className = 'msg error';
      return false;
    }
    return true;
  }
</script>

</body>
</html>