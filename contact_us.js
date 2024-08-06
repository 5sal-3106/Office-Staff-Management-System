document.addEventListener('DOMContentLoaded', function() {
    var contactForm = document.getElementById('contact-form');
    contactForm.addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent the form from submitting

        // Simulate successful submission
        showPopup();
    });

    function showPopup() {
        var popupModal = document.getElementById('popup-modal');
        popupModal.style.display = 'flex';

        // Close popup when clicking on close button
        var closeButton = document.querySelector('.close');
        closeButton.addEventListener('click', function() {
            popupModal.style.display = 'none';
        });

        // Close popup when clicking outside modal content
        window.addEventListener('click', function(event) {
            if (event.target === popupModal) {
                popupModal.style.display = 'none';
            }
        });
    }
});
