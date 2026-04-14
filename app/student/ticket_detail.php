<?php
// ============================================================
// student/ticket_detail.php — Phase 2 Frontend
// Path: Project_CS381/app/student/ticket_detail.php
// ============================================================

$student_name     = "Hadeel Awad";
$student_initials = "HA";

// Dummy ticket data — replaced with DB query in Phase 3
$ticket = [
  "id"          => 2,
  "title"       => "Projector not working in Lab 3",
  "category"    => "Hardware",
  "priority"    => "High",
  "location"    => "Lab 3, Building A",
  "description" => "The projector in Lab 3 has not been working since Monday. When I press the power button, the light blinks orange but nothing shows on screen. We have a presentation tomorrow and really need this fixed.",
  "status"      => "progress",
  "date"        => "Apr 08, 2026",
];

// Dummy response thread — replaced with DB query in Phase 3
$responses = [
  [
    "sender"   => "Hadeel Awad",
    "initials" => "HA",
    "role"     => "student",
    "message"  => "The projector in Lab 3 has not been working since Monday. Pressing power gives an orange blinking light but no display.",
    "time"     => "Apr 08, 2026 — 10:14 AM",
  ],
  [
    "sender"   => "Admin Support",
    "initials" => "AS",
    "role"     => "admin",
    "message"  => "Thank you for reporting this. We have assigned a technician to look into it. Please expect a visit to Lab 3 by tomorrow morning.",
    "time"     => "Apr 08, 2026 — 11:30 AM",
  ],
  [
    "sender"   => "Hadeel Awad",
    "initials" => "HA",
    "role"     => "student",
    "message"  => "Thank you! We have a presentation at 10 AM, so hopefully it will be fixed before then.",
    "time"     => "Apr 08, 2026 — 11:45 AM",
  ],
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>YIC IT Support — Ticket Detail</title>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet"/>
  <link rel="stylesheet" href="../css/style.css"/>
  <style>
    /* Ticket info card */
    .ticket-info {
      background: var(--glass-bg);
      border: 1px solid var(--glass-bdr);
      border-radius: var(--radius-lg);
      padding: 24px 28px;
      margin-bottom: 24px;
      backdrop-filter: blur(12px);
    }
    .ticket-info-header {
      display: flex;
      align-items: flex-start;
      justify-content: space-between;
      margin-bottom: 16px;
      gap: 16px;
    }
    .ticket-info-title { font-size: 18px; font-weight: 700; color: var(--white); }
    .ticket-meta {
      display: flex;
      flex-wrap: wrap;
      gap: 10px;
      margin-bottom: 16px;
    }
    .meta-pill {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      background: rgba(255,255,255,0.06);
      border: 1px solid var(--glass-bdr);
      border-radius: 20px;
      padding: 4px 12px;
      font-size: 11px;
      font-weight: 600;
      color: var(--muted);
    }
    .meta-pill svg { width: 12px; height: 12px; }
    .ticket-description {
      font-size: 13px;
      color: rgba(255,255,255,0.65);
      line-height: 1.8;
      padding-top: 16px;
      border-top: 1px solid var(--glass-bdr);
    }

    /* Thread section */
    .thread-section {
      background: var(--glass-bg);
      border: 1px solid var(--glass-bdr);
      border-radius: var(--radius-lg);
      overflow: hidden;
      backdrop-filter: blur(12px);
      margin-bottom: 16px;
    }
    .thread-section-header {
      padding: 16px 22px;
      border-bottom: 1px solid var(--glass-bdr);
      font-size: 14px;
      font-weight: 700;
      color: var(--white);
    }
    .thread-body { padding: 20px 22px; }

    /* Reply box */
    .reply-box {
      background: var(--glass-bg);
      border: 1px solid var(--glass-bdr);
      border-radius: var(--radius-lg);
      padding: 20px 24px;
      backdrop-filter: blur(12px);
    }
    .reply-box-title {
      font-size: 13px;
      font-weight: 700;
      color: var(--white);
      margin-bottom: 12px;
    }
    .reply-row {
      display: flex;
      gap: 10px;
      align-items: flex-end;
    }
    .reply-row textarea {
      flex: 1;
      padding: 11px 14px;
      background: rgba(255,255,255,0.06);
      border: 1px solid var(--glass-bdr);
      border-radius: var(--radius);
      font-family: var(--font);
      font-size: 13px;
      color: var(--white);
      outline: none;
      resize: none;
      min-height: 60px;
      transition: border-color 0.2s, background 0.2s;
      line-height: 1.6;
    }
    .reply-row textarea:focus {
      border-color: rgba(139,92,246,0.55);
      background: rgba(139,92,246,0.08);
    }
    .reply-row textarea::placeholder { color: var(--dimmer); }
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
      <a href="dashboard.php" class="nav-item active">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/>
          <rect x="3" y="14" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/>
        </svg>
        My Tickets
      </a>
      <a href="submit_ticket.php" class="nav-item">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <circle cx="12" cy="12" r="10"/>
          <line x1="12" y1="8" x2="12" y2="16"/>
          <line x1="8" y1="12" x2="16" y2="12"/>
        </svg>
        New Ticket
      </a>
    </nav>

    <div class="sidebar-bottom">
      <div class="user-info">
        <div class="user-avatar"><?php echo $student_initials; ?></div>
        <div>
          <div class="user-name"><?php echo $student_name; ?></div>
          <div class="user-role">Student</div>
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

    <!-- Page header -->
    <div class="page-header">
      <div>
        <h1 class="page-title">Ticket #<?php echo $ticket['id']; ?></h1>
        <p class="page-subtitle">Submitted on <?php echo $ticket['date']; ?></p>
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

    <!-- Ticket info card -->
    <div class="ticket-info">
      <div class="ticket-info-header">
        <h2 class="ticket-info-title"><?php echo htmlspecialchars($ticket['title']); ?></h2>
        <!-- Status badge -->
        <?php if ($ticket['status'] === 'open'): ?>
          <span class="badge-status badge-open">Open</span>
        <?php elseif ($ticket['status'] === 'progress'): ?>
          <span class="badge-status badge-progress">In Progress</span>
        <?php else: ?>
          <span class="badge-status badge-resolved">Resolved</span>
        <?php endif; ?>
      </div>

      <!-- Meta info pills -->
      <div class="ticket-meta">
        <span class="meta-pill">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 6h16M4 12h16M4 18h7"/></svg>
          <?php echo $ticket['category']; ?>
        </span>
        <span class="meta-pill">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
          <?php echo $ticket['date']; ?>
        </span>
        <span class="meta-pill">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
          <?php echo $ticket['location']; ?>
        </span>
        <span class="meta-pill" style="color: <?php echo $ticket['priority'] === 'High' ? 'var(--status-open)' : 'var(--muted)'; ?>">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/><polyline points="17 6 23 6 23 12"/></svg>
          <?php echo $ticket['priority']; ?> Priority
        </span>
      </div>

      <!-- Full description -->
      <p class="ticket-description"><?php echo htmlspecialchars($ticket['description']); ?></p>
    </div>

    <!-- Response thread -->
    <div class="thread-section">
      <div class="thread-section-header">Conversation</div>
      <div class="thread-body">
        <div class="thread">
          <?php foreach ($responses as $r): ?>
          <div class="thread-msg <?php echo $r['role'] === 'admin' ? 'admin-msg' : ''; ?>">
            <div class="thread-avatar <?php echo $r['role']; ?>">
              <?php echo $r['initials']; ?>
            </div>
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

    <!-- Reply box — only show if ticket is not resolved -->
    <?php if ($ticket['status'] !== 'resolved'): ?>
    <div class="reply-box">
      <p class="reply-box-title">Add a reply</p>
      <form action="../includes/tickets.php" method="POST" onsubmit="return validateReply()">
        <input type="hidden" name="action"    value="reply"/>
        <input type="hidden" name="ticket_id" value="<?php echo $ticket['id']; ?>"/>
        <div class="reply-row">
          <textarea
            id="reply-text"
            name="message"
            placeholder="Type your message here..."
            required
          ></textarea>
          <button type="submit" class="btn btn-primary" style="padding: 13px 18px; align-self: flex-end;">
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
    <?php endif; ?>

  </main>
</div>

<script>
  // Validate reply before sending
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