// When the user clicks on an item, open the corresponding modal
document.querySelectorAll('.imagesProduct').forEach(item => {
    item.addEventListener('click', function() {
        var modalId = this.getAttribute('data-target');
        var modal = document.getElementById(modalId);
        modal.style.display = "block";
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
