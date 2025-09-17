<!DOCTYPE html>
<html lang="ar" dir="ltr">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>EventFlow — Create New Event</title>

    <!-- Bootstrap -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet" />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
      rel="stylesheet" />

    <style>
      :root {
        --bg: #1a1d23;
        --panel: #2a2f3a;
        --card: #323741;
        --muted: #9ca3af;
        --line: #3f4451;
        --brand: #00d4ff;
        --input: #2a2f3a;
        --input-border: #3f4451;
        --danger: #ef4444;
        --success: #10b981;
        --cyan: #00d4ff;
        --purple: #8b5cf6;
        --yellow: #f59e0b;
        --pink: #ec4899;
        --orange: #f97316;
        --teal: #14b8a6;
        --green: #22c55e;
      }
      * {
        box-sizing: border-box;
      }
      body {
        background: var(--bg);
        color: #fff;
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
      }

      /* ===== Topbar ===== */
      .topbar {
        background: var(--panel);
        border-bottom: 1px solid var(--line);
      }
      .navbar {
        padding: 0.75rem 0;
      }
      .navbar .nav-link {
        color: #9ca3af;
        font-weight: 500;
        padding: 0.5rem 1rem;
        border-radius: 8px;
        transition: all 0.2s;
      }
      .navbar .nav-link:hover {
        color: #fff;
        background: rgba(255, 255, 255, 0.1);
      }
      .brand {
        background: linear-gradient(45deg, var(--cyan), var(--teal));
        color: #000;
        border-radius: 12px;
        padding: 8px 16px;
        font-weight: 800;
        font-size: 1.1rem;
        text-decoration: none;
        box-shadow: 0 8px 25px rgba(0, 212, 255, 0.3);
      }
      .brand:hover {
        color: #000;
        transform: translateY(-1px);
        box-shadow: 0 12px 35px rgba(0, 212, 255, 0.4);
      }
      .btn-outline-light.rounded-pill {
        border: 2px solid var(--cyan);
        color: var(--cyan);
        background: transparent;
        font-weight: 600;
        padding: 0.5rem 1.5rem;
      }
      .btn-outline-light.rounded-pill:hover {
        background: var(--cyan);
        color: #000;
        border-color: var(--cyan);
        transform: translateY(-1px);
      }

      /* ===== Page layout ===== */
      .main-content {
        display: flex;
        min-height: calc(100vh - 80px);
      }
      .sidebar {
        width: 250px;
        background: var(--panel);
        border-right: 1px solid var(--line);
        padding: 2rem 1.5rem;
      }
      .sidebar h6 {
        color: #fff;
        font-weight: 700;
        margin-bottom: 1rem;
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
      }
      .sidebar .nav-link {
        color: var(--muted);
        padding: 0.75rem 1rem;
        border-radius: 8px;
        margin-bottom: 0.5rem;
        transition: all 0.2s;
        font-weight: 500;
      }
      .sidebar .nav-link:hover {
        color: #fff;
        background: rgba(255, 255, 255, 0.1);
      }
      .sidebar .nav-link.active {
        color: var(--cyan);
        background: rgba(0, 212, 255, 0.1);
      }
      .weather-widget {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 12px;
        padding: 1rem;
        color: #fff;
        margin-top: 2rem;
      }
      .content-area {
        flex: 1;
        padding: 2rem;
      }

      /* ===== Form styling ===== */
      .form-container {
        display: grid;
        grid-template-columns: 1fr 350px;
        gap: 2rem;
        max-width: 1200px;
      }
      .form-section {
        background: var(--panel);
        border: 1px solid var(--line);
        border-radius: 16px;
        padding: 2rem;
      }
      .upload-section {
        background: var(--panel);
        border: 2px dashed var(--cyan);
        border-radius: 16px;
        padding: 2rem;
        text-align: center;
        position: relative;
      }
      .upload-area {
        border: 2px dashed var(--line);
        border-radius: 12px;
        padding: 3rem 2rem;
        background: rgba(0, 212, 255, 0.05);
        transition: all 0.3s;
      }
      .upload-area:hover {
        border-color: var(--cyan);
        background: rgba(0, 212, 255, 0.1);
      }
      .form-label {
        font-weight: 700;
        color: #fff;
        font-size: 0.9rem;
        margin-bottom: 0.5rem;
      }
      .form-control,
      .form-select,
      textarea {
        background: var(--input) !important;
        border: 1px solid var(--input-border) !important;
        color: #fff !important;
        border-radius: 8px !important;
        padding: 0.75rem !important;
      }
      .form-control:focus,
      .form-select:focus,
      textarea:focus {
        outline: 0;
        box-shadow: 0 0 0 3px rgba(0, 212, 255, 0.2);
        border-color: var(--cyan) !important;
      }
      .tag-buttons {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
        margin-top: 1rem;
      }
      .tag-btn {
        padding: 0.5rem 1rem;
        border-radius: 20px;
        border: 1px solid var(--line);
        background: transparent;
        color: var(--muted);
        font-size: 0.85rem;
        font-weight: 500;
        transition: all 0.2s;
        cursor: pointer;
      }
      .tag-btn.active,
      .tag-btn:hover {
        border-color: var(--cyan);
        color: var(--cyan);
        background: rgba(0, 212, 255, 0.1);
      }
      .preview-item {
        position: relative;
        overflow: hidden;
        border-radius: 8px;
      }
      .placeholder-img {
        width: 100%;
        background: linear-gradient(45deg, #2a2d31, #34373c);
        border: 1px solid var(--line);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--muted);
        font-size: 0.8rem;
      }
      .placeholder-img::before {
        content: "📷";
        font-size: 1.5rem;
      }
      .text-cyan {
        color: var(--cyan) !important;
      }
      .page-title {
        font-weight: 800;
        color: #fff;
        font-size: 2rem;
        margin: 0;
      }
      .meta {
        color: var(--muted);
        font-size: 0.9rem;
      }

      /* ===== Buttons ===== */
      .btn-brand {
        background: var(--brand);
        border: 0;
        color: #001;
        font-weight: 800;
        border-radius: 999px;
        padding: 0.65rem 1.2rem;
        box-shadow: 0 8px 22px rgba(46, 246, 210, 0.25);
      }
      .tags {
        gap: 10px;
      }
      .tags .btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 0.35rem 1rem;
        border-radius: 999px;
        font-weight: 700;
        background: rgba(255, 255, 255, 0.02);
        gap: 8px;
        transition: transform 0.12s ease, box-shadow 0.12s ease;
      }
      .tags .btn:hover {
        transform: translateY(-3px);
      }

      /* Outline / accent buttons */
      .btn-outline-orange {
        border: 2px solid #ff9e44;
        color: #ff9e44;
        background: transparent;
        box-shadow: 0 6px 18px rgba(255, 158, 68, 0.06),
          inset 0 0 10px rgba(255, 158, 68, 0.06);
      }

      /* Colored pill buttons */
      .btn-purple {
        border: 2px solid #a071ff;
        color: #a071ff;
        background: rgba(160, 113, 255, 0.04);
        box-shadow: inset 0 0 16px rgba(160, 113, 255, 0.06),
          0 6px 20px rgba(160, 113, 255, 0.03);
      }
      .btn-yellow {
        border: 2px solid #f5c542;
        color: #f5c542;
        background: rgba(245, 197, 66, 0.04);
        box-shadow: inset 0 0 16px rgba(245, 197, 66, 0.06),
          0 6px 20px rgba(245, 197, 66, 0.03);
      }
      .btn-cyan {
        border: 2px solid #4fc3f7;
        color: #4fc3f7;
        background: rgba(79, 195, 247, 0.04);
        box-shadow: inset 0 0 16px rgba(79, 195, 247, 0.06),
          0 6px 20px rgba(79, 195, 247, 0.03);
      }
      .btn-teal {
        border: 2px solid #22e0c4;
        color: #22e0c4;
        background: rgba(34, 224, 196, 0.04);
        box-shadow: inset 0 0 16px rgba(34, 224, 196, 0.06),
          0 6px 20px rgba(34, 224, 196, 0.03);
      }
      .btn-lime {
        border: 2px solid #9be15d;
        color: #9be15d;
        background: rgba(155, 225, 93, 0.04);
        box-shadow: inset 0 0 16px rgba(155, 225, 93, 0.06),
          0 6px 20px rgba(155, 225, 93, 0.03);
      }
      .btn-blue {
        border: 2px solid #6fb0ff;
        color: #6fb0ff;
        background: rgba(111, 176, 255, 0.04);
        box-shadow: inset 0 0 16px rgba(111, 176, 255, 0.06),
          0 6px 20px rgba(111, 176, 255, 0.03);
      }
    </style>
  </head>
  <body>
    <!-- Navigation -->
    <nav class="navbar">
      <div class="container-fluid">
        <div class="navbar-brand">
          <i class="bi bi-calendar-event me-2"></i>
          <span>EventFlow</span>
        </div>
        <div class="d-flex align-items-center gap-3">
          <button class="btn btn-outline-light btn-sm">
            <i class="bi bi-bell"></i>
          </button>
          <div class="user-avatar">
            <i class="bi bi-person-circle"></i>
          </div>
        </div>
      </div>
    </nav>

    <!-- Main Layout -->
    <div class="d-flex">
      <!-- Sidebar -->
      <div class="sidebar">
        <div class="sidebar-header">
          <h6 class="text-white mb-0">Navigation</h6>
        </div>
        
        <nav class="nav flex-column">
          <a class="nav-link active" href="#">
            <i class="bi bi-house-door me-2"></i>Dashboard
          </a>
          <a class="nav-link" href="#">
            <i class="bi bi-calendar-plus me-2"></i>Create Event
          </a>
          <a class="nav-link" href="#">
            <i class="bi bi-calendar-event me-2"></i>My Events
          </a>
          <a class="nav-link" href="#">
            <i class="bi bi-people me-2"></i>Attendees
          </a>
          <a class="nav-link" href="#">
            <i class="bi bi-graph-up me-2"></i>Analytics
          </a>
          <a class="nav-link" href="#">
            <i class="bi bi-gear me-2"></i>Settings
          </a>
        </nav>

        <!-- Weather Widget -->
        <div class="weather-widget">
          <div class="d-flex align-items-center justify-content-between">
            <div>
              <h6 class="mb-1">San Francisco</h6>
              <small class="opacity-75">Partly Cloudy</small>
            </div>
            <div class="text-end">
              <h4 class="mb-0">22°C</h4>
              <i class="bi bi-cloud-sun"></i>
            </div>
          </div>
        </div>
      </div>

      <!-- Main Content -->
      <div class="content-area">
        <!-- Header -->
        <div class="d-flex align-items-center justify-content-between mb-4">
          <div>
            <h1 class="page-title mb-1">Create New Event</h1>
            <p class="meta mb-0">Fill in the details to create your event</p>
          </div>
          <button class="btn btn-outline-light">
            <i class="bi bi-question-circle me-2"></i>Help
          </button>
        </div>

        <!-- Form Layout -->
        <div class="form-container">
          <!-- Left Column - Main Form -->
          <div class="form-section">
            <form>
              <!-- Event Title -->
              <div class="mb-4">
                <label class="form-label">Event Title</label>
                <input type="text" class="form-control" placeholder="Enter event name">
              </div>

              <!-- Event Details -->
              <div class="row mb-4">
                <div class="col-md-6">
                  <label class="form-label">Date</label>
                  <input type="date" class="form-control">
                </div>
                <div class="col-md-6">
                  <label class="form-label">Time</label>
                  <input type="time" class="form-control">
                </div>
              </div>

              <!-- Location -->
              <div class="mb-4">
                <label class="form-label">Location</label>
                <input type="text" class="form-control" placeholder="Event venue or address">
              </div>

              <!-- Category -->
              <div class="mb-4">
                <label class="form-label">Category</label>
                <select class="form-select">
                  <option>Select category</option>
                  <option>Conference</option>
                  <option>Workshop</option>
                  <option>Meetup</option>
                  <option>Party</option>
                </select>
              </div>

              <!-- Description -->
              <div class="mb-4">
                <label class="form-label">Description</label>
                <textarea class="form-control" rows="4" placeholder="Describe your event..."></textarea>
              </div>

              <!-- Tags -->
              <div class="mb-4">
                <label class="form-label">Tags</label>
                <div class="tag-buttons">
                  <button type="button" class="tag-btn active">Technology</button>
                  <button type="button" class="tag-btn">Business</button>
                  <button type="button" class="tag-btn">Social</button>
                  <button type="button" class="tag-btn">Educational</button>
                  <button type="button" class="tag-btn">Entertainment</button>
                  <button type="button" class="tag-btn">Sports</button>
                </div>
              </div>

              <!-- Action Buttons -->
              <div class="d-flex gap-3">
                <button type="submit" class="btn btn-primary">
                  <i class="bi bi-check-circle me-2"></i>Create Event
                </button>
                <button type="button" class="btn btn-outline-secondary">
                  <i class="bi bi-eye me-2"></i>Preview
                </button>
              </div>
            </form>
          </div>

          <!-- Right Column - Upload & Preview -->
          <div class="upload-section">
            <h5 class="text-white mb-3">Event Media</h5>
            <div class="upload-area">
              <i class="bi bi-cloud-upload text-cyan" style="font-size: 2.5rem;"></i>
              <h6 class="text-white mt-3 mb-2">Drag & drop files here</h6>
              <p class="text-muted small mb-3">or click to browse</p>
              <button class="btn btn-outline-primary btn-sm">
                <i class="bi bi-folder me-2"></i>Choose Files
              </button>
            </div>

            <!-- Preview Area -->
            <div class="mt-4">
              <h6 class="text-white mb-3">Gallery Preview</h6>
              <div class="row g-2">
                <div class="col-6">
                  <div class="preview-item">
                    <div class="placeholder-img bg-secondary rounded" style="height: 80px;"></div>
                  </div>
                </div>
                <div class="col-6">
                  <div class="preview-item">
                    <div class="placeholder-img bg-secondary rounded" style="height: 80px;"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
