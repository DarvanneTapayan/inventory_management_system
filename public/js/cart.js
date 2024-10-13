// public/js/cart.js
document.addEventListener('DOMContentLoaded', () => {
    const removeButtons = document.querySelectorAll('.remove-item');
    
    removeButtons.forEach(button => {
        button.addEventListener('click', function() {
            const productId = this.dataset.productId;

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
                    showNotification('Item removed from cart.', 'success');
                    this.closest('tr').remove(); // Remove the row from the cart table
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

        totalAmountElement.innerText = total.toFixed(2);
    }
});
