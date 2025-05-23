<?php 
use core\Application;
?>
<!doctype html>
<html lang="en">
  <?php include "needs.php"; ?>
  <body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <!-- App Wrapper -->
    <div class="app-wrapper">

      <!-- Header -->
      <nav class="app-header navbar navbar-expand bg-body">
        <div class="container-fluid">
          <!-- Left Navbar -->

          <!-- Right Navbar -->
          <ul class="navbar-nav ms-auto">
            <!-- Notifications -->
            <li class="nav-item dropdown">
              <a class="nav-link" data-bs-toggle="dropdown" href="#">
                <i class="bi bi-bell-fill"></i>
                <span class="navbar-badge badge text-bg-warning">15</span>
              </a>
              <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                <span class="dropdown-item dropdown-header">15 Notifications</span>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                  <i class="bi bi-envelope me-2"></i> 4 new messages
                  <span class="float-end text-secondary fs-7">3 mins</span>
                </a>
                <a href="#" class="dropdown-item">
                  <i class="bi bi-people-fill me-2"></i> 8 friend requests
                  <span class="float-end text-secondary fs-7">12 hours</span>
                </a>
                <a href="#" class="dropdown-item">
                  <i class="bi bi-file-earmark-fill me-2"></i> 3 new reports
                  <span class="float-end text-secondary fs-7">2 days</span>
                </a>
                <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
              </div>
            </li>

            <!-- Fullscreen Toggle -->
            <li class="nav-item">
              <a class="nav-link" href="#" data-lte-toggle="fullscreen">
                <i data-lte-icon="maximize" class="bi bi-arrows-fullscreen"></i>
                <i data-lte-icon="minimize" class="bi bi-fullscreen-exit" style="display: none"></i>
              </a>
            </li>

            <!-- User Menu -->
            <li class="nav-item dropdown user-menu">
              <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                <span class="d-none d-md-inline">
                  <?= Application::$app->user ? Application::$app->user->getDisplayName() : 'Hardik Traders'; ?>
                </span>
              </a>
            </li>
          </ul>
        </div>
      </nav>

      <!-- Sidebar -->
      <aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
        <div class="sidebar-brand">
          <a href="/" class="brand-link">
            <img src="images/ht_r_logo.png" alt="Hardik Traders Logo" class="brand-image opacity-75 shadow">
            <span class="brand-text fw-light">Hardik Traders</span>
          </a>
        </div>
        <div class="sidebar-wrapper">
          <nav class="mt-2">
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon bi bi-speedometer"></i>
                  <p>Dashboard <i class="nav-arrow bi bi-chevron-right"></i></p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="/dashboard" class="nav-link">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>Main Dashboard</p>
                    </a>
                  </li>
                </ul>
              </li>
            </ul>
          </nav>
        </div>
        <!-- Sidebar Footer Dropdown (at bottom of sidebar) -->
        <div class="sidebar-footer dropdown dropup text-center bg-dark text-white p-2">
          <a class="dropdown-toggle text-white text-decoration-none" href="#" role="button" id="helpMenu" data-bs-display="static" data-bs-toggle="dropdown" aria-expanded="false">
            Hardik Traders
          </a>
          <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="helpMenu">
            <li><a class="dropdown-item" href="/login">Log In</a></li>
            <li><a class="dropdown-item" href="/contact">Contact Us</a></li>
          </ul>
        </div>
      </aside>

      <!-- Main Content -->
      <main class="app-main">
        <div class="app-content-header">
          <div class="container-fluid">
            <div class="row">
              <div class="col-sm-6">
                <h3 class="mb-0">
                <?php 
                if (Application::$app->request->getPath() === '/')
                  echo "Welcome ";
                ?>
                Hardik Traders
              </h3>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="/">Home</a></li>
                  <li class="breadcrumb-item active">
                    <?= str_replace("/", "", Application::$app->request->getPath()); ?>
                  </li>
                </ol>
              </div>
            </div>
          </div>
        </div>

        <div class="app-content">
          <div class="container">
            <?php if (Application::$app->session->getFlash('success')): ?>
              <div class="alert alert-success">
                <?= Application::$app->session->getFlash('success'); ?>
                <?php Application::$app->session->remove('success'); ?>
              </div>
            <?php endif; ?>
            {{content}}
          </div>
        </div>
      </main>

      <!-- Footer -->
      <footer class="app-footer">
        <div class="float-end d-none d-sm-inline">Anything you want</div>
        <strong>&copy; 2014–2024 <a href="https://adminlte.io" class="text-decoration-none">AdminLTE.io</a>.</strong>
        All rights reserved.
      </footer>
    </div>
  </body>
</html>