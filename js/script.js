
// Get the modal


// Get the <span> element that closes the modal


// When the user clicks the button, open the modal 


// When the user clicks on <span> (x), close the modal
function show(typeModal) {
    typeModal.classList.toggle("show");

}
window.onclick = function(event) {
    if (event.target == modalSignIn) {
        document.getElementById("modalSignIn").classList.toggle("show");
    }
    if (event.target == modalSignUp) {
        document.getElementById("modalSignUp").classList.toggle("show");
    }

}
