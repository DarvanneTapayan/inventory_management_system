<?php include '../templates/header.php'; ?>
<?php include '../templates/navbar.php'; ?>

<div class="container">
    <div class="form-container">
        <h2>Login</h2>
        <form id="loginForm" action="process_login.php" method="POST">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" class="btn-primary">Login</button>
        </form>
    </div>
</div>

<script src="../public/js/ajax.js"></script>
<script src="../public/js/validation.js"></script>
<script src="../public/js/notifications.js"></script>
<script>
    document.getElementById('loginForm').addEventListener('submit', function(event) {
        event.preventDefault();
        const form = document.getElementById('loginForm');

        if (validateForm(form)) {
            ajaxSubmitForm(form, (data) => {
                showNotification('Login successful!', 'success');
                window.location.href = 'index.php';
            }, (error) => {
                showNotification(error.message || 'Login failed. Please check your credentials.', 'error');
            });
        }
    });
</script>

<?php include '../templates/footer.php'; ?>
