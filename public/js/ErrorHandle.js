
//hyda l red bar error handler
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
//hyda l red bar error handler
function showToast(message, type) {
    const toast = document.getElementById('toast');
    toast.textContent = message;
    toast.classList.remove('hidden');
    toast.classList.add('bg-' + type + '-500');
    setTimeout(function() {
        toast.classList.add('hidden');
        toast.classList.remove('bg-' + type + '-500');
    }, 3000);
}

//Script path//Script path//Script path
    {/* <script src="{{ asset('js\SuccessHandle.js') }}"></script> */}
//Script path //Script path//Script path
