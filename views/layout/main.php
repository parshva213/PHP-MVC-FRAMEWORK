<?php

use core\Application;
use core\Need;

include "needs.php";

$app = Application::$app;
$user = $app->user;
$session = $app->session;
$request = $app->request;
?>
<!doctype html>
<html lang="en">

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary" style="display: flex; flex-direction:row;">
  <!-- App Wrapper -->
  <!-- Sidebar -->
  <aside class="app-sidebar bg-body-secondary shadow" data-widget="pushmenu" data-bs-theme="dark" style="width: 13%; position:fixed; top:0; bottom:0; left:0;">
    <div class="sidebar-brand" style="width: 100%;">
      <a href="/" class="brand-link">
        <img src="images/ht_r_logo.png" alt="Hardik Traders Logo" class="brand-image opacity-75 shadow" style="width: 100%; height: 100%; border-radius: 5%;">
      </a>
      <a class="brand-link toggle-button" data-widget="pushmenu" href="#" role="button">
        <button class="btn d-lg-none toggle-button" onclick="toggleSidebar()">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
            <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z" />
          </svg>
        </button>
      </a>
    </div>

    <div class="sidebar-wrapper" style="width: 100%;">
      <nav class="mt-2">
        <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu">
          <?php if ($user && $user->isRole() === Need::ROLE_ADMIN): ?>
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
                  <a href="/adminGiveLoginPermission" class="nav-link">
                    <i class="bi bi-person"></i>
                    <p>User Register Validation</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/adminProductList" class="nav-link">
                    <i class="nav-icon bi bi-box-arrow-in-right"></i>
                    <p> Product </p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon bi bi-box-arrow-in-right"></i>
                <p>
                  View
                  <i class="nav-arrow bi bi-chevron-right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="/adminUsersview" class="nav-link">
                    <i class="nav-icon bi bi-circle"></i>
                    <p>Users</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/adminSupplierList" class="nav-link">
                    <i class="nav-icon bi bi-circle"></i>
                    <p>Suppliers</p>
                  </a>
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
    <div class="sidebar-footer dropdown dropup bg-dark text-center text-white" style="position: absolute; bottom: 0; width:100%; height:6%; padding-top:15px; font-size:140%">
      <a class="dropdown-toggle text-white text-decoration-none" href="#" role="button" id="helpMenu" data-bs-display="static" data-bs-toggle="dropdown" aria-expanded="false">
        <span class="bi bi-gear">
        </span>Personal
      </a>
      <ul class=" dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="helpMenu">
        <?php if ($session->get('user')): ?>
          <li><a class="dropdown-item" href="/logout">Logout</a></li>
          <li><a class="dropdown-item" href="/profile">Profile</a></li>
          <li><a class="dropdown-item" href="/cpass">Change Password</a></li>
        <?php else: ?>
          <li><a class="dropdown-item" href="/login">Log In</a></li>
        <?php endif ?>
      </ul>
    </div>
  </aside>
  <div class="app-wrapper" style="position:absolute; right:0; width:87%">
    <!-- Header -->
    <nav class="navbar navbar-expand bg-body" style="position: absolute; right:0; width:100%">
      <div class="container-fluid">
        <!-- Left Navbar -->
        <ul class="navbar-nav toggle-button">
          <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button">
              <button class="btn d-lg-none toggle-button" onclick="toggleSidebar()">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
                  <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5" />
                </svg>
              </button>
            </a>
          </li>
        </ul>
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
        </ul>
      </div>
    </nav>


    <!-- Main Content -->
    <main class="app-main position-absolute" style="top: 5vh; bottom:5vh; width:100%;">
      <div class="app-content-header">
        <div class="container-fluid">
          <div class="row">
            <div class="col-sm-6">
              <h3 class="mb-0">
                <?php
                if ($request->getPath() === '/')
                  echo "Welcome To";
                ?>
                Hardik Traders
              </h3>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-end">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active">
                  <?= str_replace("/", "", $request->getPath()); ?>
                </li>
              </ol>
            </div>
          </div>
        </div>
      </div>

      <div class="container container-fluid">
        <?php if ($session->getFlash('error')): ?>
          <div class="alert alert-danger">
            <?= $session->getFlash('error'); ?>
            <?php $session->removeFlash('error'); ?>
          </div>
        <?php elseif ($session->getFlash('success')): ?>
          <div class="alert alert-success">
            <?= $session->getFlash('success'); ?>
            <?php $session->removeFlash('success'); ?>
          </div>
        <?php endif; ?>
        {{content}}
      </div>
    </main>

    <!-- Footer -->
    <footer class="app-footer" style="position:fixed; right:0; bottom:0; width:87%">
      <div class="float-end d-sm-inline">Anything you want</div>
      <strong>&copy; 2002-<?php echo date("Y") ?> <a href="/" class="text-decoration-none">HT</a>.</strong>
      All rights reserved.
    </footer>
  </div>
</body>

</html>