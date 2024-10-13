document.addEventListener('DOMContentLoaded', () => {
    const removeButtons = document.querySelectorAll('.remove-item');

    removeButtons.forEach(button => {
        button.addEventListener('click', function(event) {
            event.preventDefault(); // Prevent the default action of the button

            const productId = this.dataset.productId; // Get the product ID from the button's data attribute
            const row = this.closest('tr'); // Get the closest row for removal

            // Remove item from the session cart via AJAX
            fetch('remove_from_cart.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ product_id: productId })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Notify the user
                    showNotification('Item removed from cart.', 'success');

                    // Remove the row from the cart table
                    row.remove();
                    updateTotalAmount(); // Update total amount displayed
                } else {
                    showNotification(data.message || 'Failed to remove item.', 'error');
                }
            })
            .catch(error => {
                showNotification('An error occurred. Please try again.', 'error');
            });
        });
    });

    function updateTotalAmount() {
        const totalAmountElement = document.getElementById('totalAmount');
        const itemTotals = document.querySelectorAll('.item-total');
        let total = 0;

        itemTotals.forEach(totalElement => {
            total += parseFloat(totalElement.innerText.replace('$', ''));
        });

        totalAmountElement.innerText = total.toFixed(2); // Update the displayed total amount
    }

    function showNotification(message, type) {
        // Create a notification element
        const notification = document.createElement('div');
        notification.className = `notification ${type}`; // Add class for styling
        notification.innerText = message;

        // Append the notification to the body
        document.body.appendChild(notification);

        // Automatically remove the notification after a delay
        setTimeout(() => {
            notification.remove();
        }, 3000); // Change duration as needed
    }
});
