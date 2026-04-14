<?php
// ============================================================
// admin/dashboard.php — Phase 2 Frontend
// Path: Project_CS381/app/admin/dashboard.php
// ============================================================

$admin_name     = "Admin Support";
$admin_initials = "AS";

// Dummy tickets — replaced with DB query in Phase 3
$tickets = [
  ["id" => 1, "title" => "Cannot connect to campus WiFi",     "student" => "Hadeel Awad",   "category" => "Network",  "date" => "Apr 10, 2026", "priority" => "Medium", "status" => "open"],
  ["id" => 2, "title" => "Projector not working in Lab 3",    "student" => "Sara Mohammed", "category" => "Hardware", "date" => "Apr 08, 2026", "priority" => "High",   "status" => "progress"],
  ["id" => 3, "title" => "Need access to library system",     "student" => "Lina Ahmed",    "category" => "Account",  "date" => "Apr 05, 2026", "priority" => "Low",    "status" => "resolved"],
  ["id" => 4, "title" => "Laptop charger broken in room 204", "student" => "Hadeel Awad",   "category" => "Hardware", "date" => "Apr 03, 2026", "priority" => "Medium", "status" => "resolved"],
  ["id" => 5, "title" => "Email account not syncing",         "student" => "Noura Khalid",  "category" => "Software", "date" => "Apr 01, 2026", "priority" => "High",   "status" => "progress"],
  ["id" => 6, "title" => "Printer offline in admin office",   "student" => "Reem Saleh",    "category" => "Printer",  "date" => "Mar 30, 2026", "priority" => "Low",    "status" => "open"],
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>YIC IT Support — Admin Dashboard</title>
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
        All Tickets
      </a>
      <a href="assign_ticket.php" class="nav-item">
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

    <!-- Page header -->
    <div class="page-header">
      <div>
        <h1 class="page-title">Admin Dashboard</h1>
        <p class="page-subtitle">Manage and respond to all support tickets</p>
      </div>
    </div>

    <!-- Stat cards -->
    <div class="stats-row">
      <div class="stat-card">
        <div class="stat-label">Total tickets</div>
        <div class="stat-number">6</div>
        <div class="stat-sub">All time</div>
      </div>
      <div class="stat-card">
        <div class="stat-label">Open</div>
        <div class="stat-number" style="color:var(--status-open);">2</div>
        <div class="stat-sub">Need attention</div>
      </div>
      <div class="stat-card">
        <div class="stat-label">In progress</div>
        <div class="stat-number" style="color:var(--status-progress);">2</div>
        <div class="stat-sub">Being handled</div>
      </div>
      <div class="stat-card">
        <div class="stat-label">Resolved</div>
        <div class="stat-number" style="color:var(--status-resolved);">2</div>
        <div class="stat-sub">Closed tickets</div>
      </div>
    </div>

    <!-- All tickets table -->
    <div class="table-wrap">
      <div class="table-header">
        <span class="table-title">All tickets</span>
      </div>
      <table>
        <thead>
          <tr>
            <th>#</th>
            <th>Title</th>
            <th>Student</th>
            <th>Category</th>
            <th>Priority</th>
            <th>Date</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($tickets as $t): ?>
          <tr>
            <td style="color:var(--muted);">#<?php echo $t['id']; ?></td>
            <td><?php echo htmlspecialchars($t['title']); ?></td>
            <td style="color:var(--muted);"><?php echo $t['student']; ?></td>
            <td style="color:var(--muted);"><?php echo $t['category']; ?></td>
            <td>
              <span style="font-size:12px;font-weight:600;color:<?php echo $t['priority']==='High' ? 'var(--status-open)' : ($t['priority']==='Medium' ? 'var(--status-progress)' : 'var(--muted)'); ?>">
                <?php echo $t['priority']; ?>
              </span>
            </td>
            <td style="color:var(--muted);"><?php echo $t['date']; ?></td>
            <td>
              <?php if ($t['status']==='open'): ?>
                <span class="badge-status badge-open">Open</span>
              <?php elseif ($t['status']==='progress'): ?>
                <span class="badge-status badge-progress">In Progress</span>
              <?php else: ?>
                <span class="badge-status badge-resolved">Resolved</span>
              <?php endif; ?>
            </td>
            <td>
              <a href="assign_ticket.php?id=<?php echo $t['id']; ?>">
                <button class="btn btn-ghost" style="padding:6px 14px;font-size:12px;">
                  Manage
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