<?php

use core\Application;

$this->title = "Home" . $name;
$db = Application::$app->db->pdo;

// Get total user count
$sql = "SELECT count(*) FROM ausers";
$statement = $db->prepare($sql);
$statement->execute();
$count = $statement->fetchColumn() ?? 10;

// Format display count user
$displayCount = ($count < 10) ? $count
    : (($count < 100) ? (floor($count / 10) * 10 - 1) . " + "
        : (($count < 1000) ? (floor($count / 100) * 100 - 1) . " + "
            : (($count < 10000) ? (floor($count / 1000) * 1000 - 1) . " + " : $count)));

?>
<div class="line">
    <div class="card text-center shadow" style="width: 20rem;" <?php if (Application::$app->user && Application::$app->user->isAdmin()): ?>onclick="window.location.href='/usersview'" <?php endif; ?>>
        <div class="card-body bg-primary text-white d-flex align-items-center justify-content-center" style="height: 150px;">
            <h1 class="display-4 m-0 fw-bold"><?= $displayCount ?></h1>
        </div>
        <div class="card-footer bg-light text-dark">
            <p class="card-text">Users</p>
        </div>
    </div>
</div>