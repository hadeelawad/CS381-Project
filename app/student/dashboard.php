<?php
// ============================================================
// student/dashboard.php — Phase 2 Frontend
// Path: Project_CS381/app/student/dashboard.php
// ============================================================

// Dummy data — will be replaced with real DB data in Phase 3
$student_name     = "Hadeel Awad";
$student_initials = "HA";

$tickets = [
  ["id" => 1, "title" => "Cannot connect to campus WiFi",     "date" => "Apr 10, 2026", "status" => "open"],
  ["id" => 2, "title" => "Projector not working in Lab 3",    "date" => "Apr 08, 2026", "status" => "progress"],
  ["id" => 3, "title" => "Need access to library system",     "date" => "Apr 05, 2026", "status" => "resolved"],
  ["id" => 4, "title" => "Laptop charger broken in room 204", "date" => "Apr 03, 2026", "status" => "resolved"],
  ["id" => 5, "title" => "Email account not syncing",         "date" => "Apr 01, 2026", "status" => "progress"],
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>YIC IT Support — My Tickets</title>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet"/>
  <link rel="stylesheet" href="../css/style.css"/>
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
        <h1 class="page-title">My Tickets</h1>
        <p class="page-subtitle">Track and manage your support requests</p>
      </div>
      <a href="submit_ticket.php">
        <button class="btn btn-primary">
          <svg viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <line x1="12" y1="5" x2="12" y2="19"/>
            <line x1="5" y1="12" x2="19" y2="12"/>
          </svg>
          New Ticket
        </button>
      </a>
    </div>

    <!-- Stat cards -->
    <div class="stats-row">
      <div class="stat-card">
        <div class="stat-label">Total tickets</div>
        <div class="stat-number">5</div>
        <div class="stat-sub">All time</div>
      </div>
      <div class="stat-card">
        <div class="stat-label">Open</div>
        <div class="stat-number" style="color: var(--status-open);">1</div>
        <div class="stat-sub">Waiting for response</div>
      </div>
      <div class="stat-card">
        <div class="stat-label">In progress</div>
        <div class="stat-number" style="color: var(--status-progress);">2</div>
        <div class="stat-sub">Being handled</div>
      </div>
      <div class="stat-card">
        <div class="stat-label">Resolved</div>
        <div class="stat-number" style="color: var(--status-resolved);">2</div>
        <div class="stat-sub">Issues closed</div>
      </div>
    </div>

    <!-- Tickets table -->
    <div class="table-wrap">
      <div class="table-header">
        <span class="table-title">All my tickets</span>
      </div>
      <table>
        <thead>
          <tr>
            <th>#</th>
            <th>Title</th>
            <th>Date submitted</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($tickets as $ticket): ?>
          <tr>
            <td style="color: var(--muted);">#<?php echo $ticket['id']; ?></td>
            <td><?php echo htmlspecialchars($ticket['title']); ?></td>
            <td style="color: var(--muted);"><?php echo $ticket['date']; ?></td>
            <td>
              <?php if ($ticket['status'] === 'open'): ?>
                <span class="badge-status badge-open">Open</span>
              <?php elseif ($ticket['status'] === 'progress'): ?>
                <span class="badge-status badge-progress">In Progress</span>
              <?php else: ?>
                <span class="badge-status badge-resolved">Resolved</span>
              <?php endif; ?>
            </td>
            <td>
              <a href="ticket_detail.php?id=<?php echo $ticket['id']; ?>">
                <button class="btn btn-ghost" style="padding: 6px 14px; font-size: 12px;">
                  View
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:13px;height:13px;">
                    <path d="M5 12h14M12 5l7 7-7 7"/>
                  </svg>
                </button>
              </a>
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>

  </main>
</div>

</body>
</html>