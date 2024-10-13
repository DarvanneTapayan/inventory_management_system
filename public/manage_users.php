<?php include '../templates/header.php'; ?>
<?php include '../templates/navbar.php'; ?>
<?php
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.php");
    exit();
}
?>

<div class="container">
    <h2>Manage Users</h2>
    <h3>Admin Users</h3>
    <table>
        <thead>
            <tr>
                <th>Username</th>
                <th>Email</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            require_once '../app/classes/User.php';
            $user = new User();
            $users = $user->getAllUsers();

            // Display admin users
            foreach ($users as $usr) {
                if ($usr['role'] === 'admin') {
                    echo "<tr>
                            <td>" . htmlspecialchars($usr['username']) . "</td>
                            <td>" . htmlspecialchars($usr['email']) . "</td>
                            <td>" . htmlspecialchars($usr['role']) . "</td>
                            <td>
                                <a href='edit_user.php?id=" . $usr['id'] . "' class='btn-secondary'>Edit</a>
                                <a href='delete_user.php?id=" . $usr['id'] . "' class='btn-secondary' onclick='return confirm(\"Are you sure you want to delete this user?\");'>Delete</a>
                            </td>
                        </tr>";
                }
            }
            ?>
        </tbody>
    </table>

    <h3>Regular Users</h3>
    <table>
        <thead>
            <tr>
                <th>Username</th>
                <th>Email</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Display regular users
            foreach ($users as $usr) {
                if ($usr['role'] === 'user') {
                    echo "<tr>
                            <td>" . htmlspecialchars($usr['username']) . "</td>
                            <td>" . htmlspecialchars($usr['email']) . "</td>
                            <td>" . htmlspecialchars($usr['role']) . "</td>
                            <td>
                                <a href='edit_user.php?id=" . $usr['id'] . "' class='btn-secondary'>Edit</a>
                                <a href='delete_user.php?id=" . $usr['id'] . "' class='btn-secondary' onclick='return confirm(\"Are you sure you want to delete this user?\");'>Delete</a>
                            </td>
                        </tr>";
                }
            }
            ?>
        </tbody>
    </table>
</div>

<script src="../public/js/notifications.js"></script>

<?php include '../templates/footer.php'; ?>
