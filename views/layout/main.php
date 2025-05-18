<?php
use core\Application;
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <title>Bootstrap demo</title> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ENjdO4Dr2bkBIFxQpeoSzu3e0p3FQck7nKqkLkFf9CbtGozYQnN0pQ5ErvY+XW9N" crossorigin="anonymous">
  </head>
  <body>
    <nav id="navbar-example2" class="navbar bg-body-tertiary px-3 mb-3">
        <ul class="nav nav-pills">
            <li class="nav-item">
                <a class="navbar-brand" href="#">Navbar</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/contact">Contact</a>
            </li>
        </ul>
        <ul class="nav nav-pills">
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                    <?php echo !isset(Application::$app->user) ? 'Hardik Traders' : Application::$app->user->getDisplayName(); ?>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <?php if(!isset(Application::$app->user)): ?>
                        <li><a class="dropdown-item" href="/login">Login</a></li>
                        <li><a class="dropdown-item" href="/register">Register</a></li>
                    <?php else: ?>
                        <li><a class="dropdown-item" href="/profile">Profile</a></li>
                        <li><a class="dropdown-item" href="/logout">Logout</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </ul>
    </nav>
    <div class="container">
        <?php if(Application::$app->session->getFlash('success')): ?>
            <div class="alert alert-success">
                <?php 
                    echo Application::$app->session->getFlash('success');
                ?>
            </div>
        <?php endif; ?>
        {{content}}
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
  </body>
</html>