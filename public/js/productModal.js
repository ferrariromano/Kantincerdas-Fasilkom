// When the user clicks on an item, open the corresponding modal and reset to view 1
document.querySelectorAll('.imagesProduct').forEach(item => {
    item.addEventListener('click', function() {
        var modalId = this.getAttribute('data-target');
        var modal = document.getElementById(modalId);
        modal.style.display = "block";

        // Reset to view 1
        var modalContent = modal.querySelector('.modal-content');
        modalContent.querySelectorAll('.modal-body').forEach(view => {
            view.style.display = 'none';
        });
        modalContent.querySelector('.view-1').style.display = 'flex';
    });
});

// When the user clicks on <span> (x), close the modal
document.querySelectorAll('.close').forEach(closeBtn => {
    closeBtn.onclick = function() {
        var modal = this.closest('.modal');
        modal.style.display = "none";
    };
});

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target.classList.contains('modal')) {
        event.target.style.display = "none";
    }
}

// Switch between views
document.querySelectorAll('.switchView').forEach(button => {
    button.addEventListener('click', function() {
        var targetView = this.getAttribute('data-target');
        var currentModal = this.closest('.modal-content');
        currentModal.querySelectorAll('.modal-body').forEach(view => {
            view.style.display = 'none';
        });
        currentModal.querySelector('.' + targetView).style.display = 'flex';
    });
});
