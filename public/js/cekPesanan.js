document.addEventListener('DOMContentLoaded', () => {
    const closeButtons = document.querySelectorAll('.alert .closebtn');
    closeButtons.forEach(button => {
        button.addEventListener('click', function() {
            this.parentElement.style.display = 'none';
        });
    });
});
