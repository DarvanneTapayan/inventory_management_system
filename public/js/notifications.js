function showNotification(message, type) {
    const notification = document.createElement('div');
    notification.className = `notification ${type}`;
    notification.innerText = message;
    
    document.body.appendChild(notification);
    
    // Remove the notification after a few seconds
    setTimeout(() => {
        notification.remove();
    }, 3000); // Adjust the time as needed
}
