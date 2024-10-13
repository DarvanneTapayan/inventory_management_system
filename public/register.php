<?php include '../templates/header.php'; ?>
<?php include '../templates/navbar.php'; ?>

<div class="container">
    <div class="form-container">
        <h2>Register</h2>
        <form id="registerForm" action="process_register.php" method="POST">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="phone">Phone:</label>
                <input type="text" id="phone" name="phone">
            </div>
            <button type="submit" class="btn-primary">Register</button>
        </form>
    </div>
</div>

<script src="../public/js/ajax.js"></script>
<script src="../public/js/validation.js"></script>
<script src="../public/js/notifications.js"></script>
<script>
    document.getElementById('registerForm').addEventListener('submit', function(event) {
        event.preventDefault();
        const form = document.getElementById('registerForm');

        if (validateForm(form)) {
            ajaxSubmitForm(form, (data) => {
                showNotification('Registration successful!', 'success');
                window.location.href = 'login.php';
            }, (error) => {
                showNotification(error.message || 'Registration failed. Please try again.', 'error');
            });
        }
    });
</script>

<?php include '../templates/footer.php'; ?>
