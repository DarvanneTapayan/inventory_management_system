<?php include '../templates/header.php'; ?>
<?php include '../templates/navbar.php'; ?>

<div class="container">
    <div class="contact-info-container">
        <h2>Contact Us</h2>
        <p>If you have any questions or inquiries, feel free to reach out to us through the following methods:</p>
        
        <h3>Our Contact Information:</h3>
        <ul>
            <li><strong>Phone:</strong> <a href="tel:+1234567890">+1 234 567 890</a></li>
            <li><strong>Email:</strong> <a href="mailto:info@cakebakeshop.com">info@cakebakeshop.com</a></li>
            <li><strong>Facebook:</strong> <a href="https://facebook.com/cakebakeshop" target="_blank">facebook.com/cakebakeshop</a></li>
            <li><strong>Instagram:</strong> <a href="https://instagram.com/cakebakeshop" target="_blank">instagram.com/cakebakeshop</a></li>
        </ul>
        
        <p>We look forward to hearing from you!</p>
    </div>
</div>

<div class="container">
    <div class="form-container">
        <h2>Contact Us</h2>
        <form action="send_message.php" method="POST">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="message">Message:</label>
                <textarea id="message" name="message" rows="5" required></textarea>
            </div>
            <button type="submit" class="btn-primary">Send Message</button>
        </form>
    </div>
</div>

<script src="../public/js/notifications.js"></script>
<script>
    document.querySelector('form[action="send_message.php"]').addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent default form submission
        ajaxSubmitForm(this); // Call your AJAX function
    });

    function ajaxSubmitForm(form) {
        var formData = new FormData(form);
        fetch(form.action, {
            method: 'POST',
            body: formData
        })
        .then(response => response.text()) // Get the response as text first
        .then(text => {
            try {
                const data = JSON.parse(text); // Try to parse it as JSON
                if (data.success) {
                    showNotification(data.message, 'success'); // Display success message in notification
                } else {
                    showNotification(data.message || 'Failed to send message.', 'error');
                }
            } catch (error) {
                console.error('Error parsing JSON:', error);
                console.log('Response received:', text); // Log the actual response
                showNotification('An error occurred. Please try again.', 'error');
            }
        })
        .catch(error => {
            console.error('There has been a problem with your fetch operation:', error);
            showNotification('An error occurred. Please try again.', 'error');
        });
    }
</script>

<?php include '../templates/footer.php'; ?>
