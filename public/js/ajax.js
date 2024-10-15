function ajaxSubmitForm(form) {
    var formData = new FormData(form);
    fetch(form.action, {
        method: 'POST',
        body: formData
    })
    .then(response => {
        return response.text(); // Get the response as text first
    })
    .then(text => {
        try {
            const data = JSON.parse(text); // Try to parse it as JSON
            if (data.success) {
                showNotification(data.message, 'success');
                // Check the user role from the data and redirect accordingly
                if (data.role === 'admin') {
                    window.location.href = "admin_dashboard.php"; // Redirect to the admin dashboard
                } else {
                    window.location.href = "index.php"; // Redirect to the index page
                }
            } else {
                showNotification(data.message || 'Failed to process order.', 'error');
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
