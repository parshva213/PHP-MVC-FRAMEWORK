<?php

use core\Application;

$this->title = "Access";
$db = Application::$app->db->pdo;
$sql = "SELECT * from causers";
$statement = $db->prepare($sql);
$statement->execute();
$records = $statement->fetchAll(PDO::FETCH_ASSOC);

?>

<div class="table-responsive" style="max-height: 300px; overflow-y: auto;">
    <table class="table table-striped">
        <thead class="thead-dark">
            <tr>
                <th>Name</th>
                <th>Username</th>
                <th>Role</th>
                <th>Email</th>
                <th>Contact</th>
                <th>Address</th>
                <th>Access</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (count($records) > 0):
                foreach ($records as $record):
                    $role = ($record['user_type'] == "o") ? "Owner" : (($record['user_type'] == "c") ? "Customer" : (($record['user_type'] == "m") ? "Manufacturer" : (($record['user_type'] == "s") ? "Supplier" : "")));
            ?>
                    <tr>
                        <td><?= htmlspecialchars($record['firstname'] . ' ' . $record['lastname']) ?></td>
                        <td><?= htmlspecialchars($record['username']) ?></td>
                        <td><?= htmlspecialchars($role) ?></td>
                        <td><?= htmlspecialchars($record['email']) ?></td>
                        <td><?= htmlspecialchars($record['contact']) ?></td>
                        <td><?= htmlspecialchars($record['address']) ?></td>
                        <td>
                            <button type="submit" class="btn btn-outline-success allow-btn edit-slink" data-uid="<?= htmlspecialchars($record['uid']) ?>">Allow</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7" class="text-center">All Users Are Activated</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('body').on('click', '.edit-slink', function(e) {
            e.preventDefault(); // stop default button action

            const uid = $(this).data('uid');
            $.ajax({
                url: '/giveAccess', // update to correct PHP script
                type: 'POST',
                data: {
                    uid: uid
                },
                success: function(response) {
                    location.reload(); // optionally refresh page
                },
                error: function(xhr) {
                    alert('Error: ' + xhr.responseText);
                }
            });
        });
    });
</script>


<!-- <script>
    alert(1);
    $(document).ready(function() {

        $('body').on('submit', '.edit-slink', function(e) {

            alert(1);
            $.ajax({
                url: "demo_test.txt",
                success: function(result) {
                    $("#div1").html(result);
                }
            });
        });
    });
</script> -->



<!-- <script>
    document.addEventListener("DOMContentLoaded", function() {
        const buttons = document.querySelectorAll('.allow-btn');
        buttons.forEach(button => {
            button.addEventListener('click', function() {
                const uid = this.getAttribute('data-uid');
                fetch('giveAccessPermission.php', {
                        method: 'POST',
                        body: 'uid=' + encodeURIComponent(uid)
                    })
                    .then(response => response.text())
                    .then(result => {
                        if (result === 'success') {
                            alert("User deleted successfully");
                            location.reload(); // reload the page to update table
                        } else {
                            alert("Error: " + result);
                        }
                    })
                    .catch(error => {
                        console.error("Error:", error);
                        alert("An error occurred");
                    });
            })
        })
    });
</script> -->