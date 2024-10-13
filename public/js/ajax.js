function ajaxSubmitForm(form) {
    var formData = new FormData(form);
    fetch(form.action, {
        method: 'POST',
        body: formData
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json(); // Parse the response as JSON
    })
    .then(data => {
        if (data.success) {
            // Handle success response
            showNotification(data.message, 'success');
            // Optionally redirect or update the UI
            window.location.href = "success_page.php"; // Redirect to a success page
        } else {
            // Handle error response
            showNotification(data.message || 'Failed to process order.', 'error');
        }
    })
    .catch(error => {
        console.error('There has been a problem with your fetch operation:', error);
        showNotification('An error occurred. Please try again.', 'error');
    });
}
