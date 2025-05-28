<!-- ========== HEAD SECTION ========== -->

<head>
  <meta charset="utf-8" />
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="title" content="Hardik Traders" />
  <meta name="author" content="HT" />
  <meta name="keywords" content="Sari Fall, Astar" />
  <title>Hardik Traders | <?php echo $this->title; ?></title>

  <!-- Google Fonts -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css" integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q=" crossorigin="anonymous" />

  <!-- Bootstrap 5.3.6 -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous" />

  <!-- Bootstrap Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" integrity="sha256-9kPW/n5nn53j4WMRYAxe9c1rCY96Oogo/MKSVdKzPmI=" crossorigin="anonymous" />

  <!-- OverlayScrollbars -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/styles/overlayscrollbars.min.css" integrity="sha256-tZHrRjVqNSRyWg2wbppGnT833E/Ys0DHWGwT04GiqQg=" crossorigin="anonymous" />

  <!-- AdminLTE (Local) -->
  <link rel="stylesheet" href="css/adminlte.css" />

  <!-- Custom Inline Styles -->
  <style>
    .toggle-button {
      display: none;
    }

    /* Optional: open submenu on hover */
    .dropdown-menu>.dropend:hover>.dropdown-menu {
      display: block;
      margin-top: -1px;
    }



    @media screen and (max-width: 992px) {

      .sidebar-footer {
        text-align: start;
        width: 100%;
        display: none;
      }

      .app-sidebar {
        position: fixed;
        left: -250px;
        transition: right 0.3s ease-in-out;
        /* Hide sidebar off-screen */

      }

      .sidebar-brand {
        display: flex;
        justify-content: space-between;
      }

      .sidebar-wrapper {
        min-height: 90vh;
        max-height: 95vh;
      }

      .toggle-button {
        display: block;
      }

      .sidebar-visible {
        left: 0;
        transition: left 0.3s ease-in-out;
        position: fixed;
        background-color: #000;
        bottom: 0;
        top: 0;
        z-index: 9999;
        width: 100%;
      }

      .app-main {
        margin-left: 0;
        transition: margin-left 0.3s ease-in-out;
      }

      td {
        width: fit-content;
      }

      .user-table {
        max-height: 900px;
        overflow-y: auto;
        max-width: 50px;
        overflow-x: auto;
      }


    }
  </style>
</head>


<!-- ========== JS SECTION ========== -->

<!-- Required: Popper.js for Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>

<!-- Bootstrap JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>

<!-- OverlayScrollbars JS -->
<script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/browser/overlayscrollbars.browser.es6.min.js" integrity="sha256-dghWARbRe2eLlIJ56wNB+b760ywulqK3DzZYEpsg2fQ=" crossorigin="anonymous"></script>

<!-- AdminLTE (Local) -->
<script src="/js/adminlte.js"></script>

<!-- ApexCharts -->
<script src="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.min.js" integrity="sha256-+vh8GkaU7C9/wbSLIcwq82tQ2wTf44aOHA8HlBMwRI8=" crossorigin="anonymous"></script>

<!-- jsVectorMap -->
<script src="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/js/jsvectormap.min.js" integrity="sha256-/t1nN2956BT869E6H4V1dnt0X5pAQHPytli+1nTZm2Y=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/maps/world.js" integrity="sha256-XPpPaZlU8S/HWf7FZLAncLg2SAkP8ScUTII89x9D3lY=" crossorigin="anonymous"></script>

<!-- SortableJS -->
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js" integrity="sha256-ipiJrswvAR4VAx/th+6zWsdeYmVae0iJuiR+6OqHJHQ=" crossorigin="anonymous"></script>

<script>
  document.addEventListener("DOMContentLoaded", function() {
    // Enable OverlayScrollbars
    const sidebarWrapper = document.querySelector(".sidebar-wrapper");
    if (sidebarWrapper && typeof OverlayScrollbarsGlobal?.OverlayScrollbars !== "undefined") {
      OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
        scrollbars: {
          theme: "os-theme-light",
          autoHide: "leave",
          clickScroll: true,
        },
      });
    }
  });

  function toggleSidebar() {
    console.log("Toggle Sidebar function called");
    const sidebar = document.querySelector('.app-sidebar') ?? document.querySelector('.sidebar-visible');
    if (sidebar) {
      console.log("Sidebar element found");
      if (sidebar.classList.contains('sidebar-visible')) {
        sidebar.classList.remove('sidebar-visible');
        sidebar.classList.add('app-sidebar');
      } else {
        sidebar.classList.add('sidebar-visible');
        sidebar.classList.remove('app-sidebar');

      }
      const mainContent = document.querySelector('.app-main');
      mainContent.style.marginLeft = 0;
      const sidebarFooter = document.querySelector('.sidebar-footer');
      if (sidebarFooter) {
        sidebarFooter.style.display === 'block' ? sidebarFooter.style.display = 'none' : sidebarFooter.style.display = 'block';
      }
    } else {
      console.error("Sidebar element not found");
    }
  }


  window.addEventListener('resize', function() {

    document.documentElement.style.setProperty('--device-width', window.innerWidth + 'px');
  });
</script>