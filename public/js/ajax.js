// public/js/ajax.js

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
        return response.json();
    })
    .then(data => {
        if (data.success) {
            showNotification('Order placed successfully!', 'success');
            window.location.href = 'index.php'; // Redirect after successful order
        } else {
            console.error('Error from server:', data.message);
            showNotification(data.message || 'Failed to place order.', 'error');
        }
    })
    .catch(error => {
        console.error('There has been a problem with your fetch operation:', error);
        showNotification('An error occurred. Please try again.', 'error');
    });
}
