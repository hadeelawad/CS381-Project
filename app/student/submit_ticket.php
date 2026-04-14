<?php
// ============================================================
// student/submit_ticket.php — Phase 2 Frontend
// Path: Project_CS381/app/student/submit_ticket.php
// ============================================================

$student_name     = "Hadeel Awad";
$student_initials = "HA";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>YIC IT Support — Submit Ticket</title>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet"/>
  <link rel="stylesheet" href="../css/style.css"/>
</head>
<body>

<div class="layout">

  <!-- ============================================================
       SIDEBAR (same on every student page)
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
        My Tickets
      </a>
      <a href="submit_ticket.php" class="nav-item active">
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

    <div class="page-header">
      <div>
        <h1 class="page-title">Submit a Ticket</h1>
        <p class="page-subtitle">Describe your issue and we'll get back to you</p>
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

    <!-- Form card -->
    <div class="form-card">

      <div class="msg" id="form-msg"></div>

      <!-- action will connect to PHP handler in Phase 3 -->
      <form action="../includes/tickets.php" method="POST" onsubmit="return validateTicket()">
        <input type="hidden" name="action" value="submit"/>

        <!-- Category selector -->
        <div class="field">
          <label>Category</label>
          <select name="category" id="category" required>
            <option value="" disabled selected>Select a category</option>
            <option value="network">Network / WiFi</option>
            <option value="hardware">Hardware</option>
            <option value="software">Software</option>
            <option value="account">Account / Access</option>
            <option value="printer">Printer</option>
            <option value="other">Other</option>
          </select>
        </div>

        <!-- Ticket title -->
        <div class="field">
          <label>Title</label>
          <input
            type="text"
            id="ticket-title"
            name="title"
            placeholder="Short summary of the issue (e.g. Cannot connect to WiFi)"
            required
          />
        </div>

        <!-- Description -->
        <div class="field">
          <label>Description</label>
          <textarea
            id="ticket-desc"
            name="description"
            placeholder="Describe the problem in detail — what happened, when, where, and any error messages you saw."
            required
          ></textarea>
        </div>

        <!-- Location -->
        <div class="field">
          <label>Location <span style="color:var(--muted);font-size:10px;text-transform:none;letter-spacing:0;">(optional)</span></label>
          <input
            type="text"
            name="location"
            placeholder="e.g. Lab 3, Building A, Room 204"
          />
        </div>

        <!-- Priority -->
        <div class="field">
          <label>Priority</label>
          <select name="priority" required>
            <option value="" disabled selected>Select priority</option>
            <option value="low">Low — not urgent</option>
            <option value="medium" selected>Medium — affects my work</option>
            <option value="high">High — urgent, blocking me</option>
          </select>
        </div>

        <!-- Submit button -->
        <div style="display:flex; gap:12px; margin-top:8px;">
          <button type="submit" class="btn btn-primary" style="flex:1; justify-content:center; padding:13px;">
            <svg viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
              <line x1="22" y1="2" x2="11" y2="13"/>
              <polygon points="22 2 15 22 11 13 2 9 22 2"/>
            </svg>
            Submit Ticket
          </button>
          <a href="dashboard.php">
            <button type="button" class="btn btn-ghost" style="padding:13px 20px;">
              Cancel
            </button>
          </a>
        </div>

      </form>
    </div>

  </main>
</div>

<script>
  // Validate the ticket form before submitting to PHP
  function validateTicket() {
    const category = document.getElementById('category').value;
    const title    = document.getElementById('ticket-title').value.trim();
    const desc     = document.getElementById('ticket-desc').value.trim();
    const msg      = document.getElementById('form-msg');

    if (!category) {
      msg.textContent = 'Please select a category.';
      msg.className = 'msg error';
      return false;
    }
    if (!title) {
      msg.textContent = 'Please enter a title for your ticket.';
      msg.className = 'msg error';
      return false;
    }
    if (desc.length < 20) {
      msg.textContent = 'Please describe the issue in more detail (at least 20 characters).';
      msg.className = 'msg error';
      return false;
    }
    return true; // submits to tickets.php in Phase 3
  }
</script>

</body>
</html>