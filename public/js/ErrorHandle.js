function showError(message) {
    var errorMessage = document.getElementById("error-message");
    errorMessage.innerHTML = message;
    errorMessage.style.display = "block"; 
    errorMessage.style.animation = "slide-down 0.8s forwards"; 
    setTimeout(hideError, 3000); 
}
function hideError() {
    var errorMessage = document.getElementById("error-message");
    errorMessage.style.animation = "fade-out 0.8s forwards"; 
    setTimeout(function() {
        errorMessage.style.display = "none"; 
    }, 700); 
}
