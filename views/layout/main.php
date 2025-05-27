<?php

use core\Application;

include "needs.php";
?>
<!doctype html>
<html lang="en">

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
                Hardik Traders
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
            <?php if (Application::$app->user && Application::$app->user->isAdmin()): ?>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon bi bi-speedometer"></i>
                  <p>
                    Manage
                    <i class="nav-arrow bi bi-chevron-right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="bi bi-person"></i>
                      <p>
                        Users
                        <i class="nav-arrow bi bi-chevron-right"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                      <li class="nav-item">
                        <a href="/givePermission" class="nav-link">
                          <i class="nav-icon bi bi-circle"></i>
                          <p>Access Give</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="./examples/register.html" class="nav-link">
                          <i class="nav-icon bi bi-circle"></i>
                          <p>Access Take</p>
                        </a>
                      </li>
                    </ul>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="nav-icon bi bi-box-arrow-in-right"></i>
                      <p>
                        Product
                        <i class="nav-arrow bi bi-chevron-right"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                      <li class="nav-item">
                        <a href="./examples/login-v2.html" class="nav-link">
                          <i class="nav-icon bi bi-circle"></i>
                          <p>List</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="./examples/register-v2.html" class="nav-link">
                          <i class="nav-icon bi bi-circle"></i>
                          <p>Modify</p>
                        </a>
                      </li>
                    </ul>
                  </li>
                </ul>
              </li>
            <?php endif; ?>
            <li class="nav-item"><a class="nav-link" href="/contact">
                <i class="bi bi-chat-square"></i>
                <p>Contact Us</p>
              </a>
            </li>
          </ul>
        </nav>
      </div>
      <!-- Sidebar Footer Dropdown (at bottom of sidebar) -->
      <div class="sidebar-footer dropdown dropup text-center bg-dark text-white p-2">
        <a class="dropdown-toggle text-white text-decoration-none" href="#" role="button" id="helpMenu" data-bs-display="static" data-bs-toggle="dropdown" aria-expanded="false">
          <span class="bi bi-gear">
          </span>Personal
        </a>
        <ul class=" dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="helpMenu">
          <?php if (Application::$app->session->get('user')): ?>
            <li><a class="dropdown-item" href="/logout">Logout</a></li>
            <li><a class="dropdown-item" href="/profile">Profile</a></li>
          <?php else: ?>
            <li><a class="dropdown-item" href="/login">Log In</a></li>
          <?php endif ?>
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
                  echo "Welcome To";
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
          <?php if (Application::$app->session->getFlash('error')): ?>
            <div class="alert alert-danger">
              <?= Application::$app->session->getFlash('error'); ?>
              <?php Application::$app->session->remove('error'); ?>
            </div>
          <?php elseif (Application::$app->session->getFlash('success')): ?>
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
      <strong>&copy; 2002-<?php echo date("Y") ?> <a href="https://adminlte.io" class="text-decoration-none">HT</a>.</strong>
      All rights reserved.
    </footer>
  </div>
</body>

</html>