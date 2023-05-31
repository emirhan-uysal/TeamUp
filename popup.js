var popup = document.querySelector('.popup-message');
var closeButton = document.querySelector('.close-button');

closeButton.addEventListener('click', function() {
  closePopup();
});

setTimeout(function() {
  closePopup();
}, 5000);

function closePopup() {
  popup.style.opacity = 0;
  setTimeout(function() {
    popup.style.display = 'none';
  }, 300);
}
