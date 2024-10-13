function validateForm(form) {
    let isValid = true;
    const inputs = form.querySelectorAll('input, textarea');

    inputs.forEach(input => {
        if (!input.checkValidity()) {
            isValid = false;
            input.classList.add('invalid');
        } else {
            input.classList.remove('invalid');
        }
    });

    return isValid;
}
