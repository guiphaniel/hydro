
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
function onSignIn(googleUser) {
    // Useful data for your client-side scripts:
    var profile = googleUser.getBasicProfile();
    console.log("ID: " + profile.getId()); // Don't send this directly to your server!
    console.log('Full Name: ' + profile.getName());
    console.log('Given Name: ' + profile.getGivenName());
    console.log('Family Name: ' + profile.getFamilyName());
    console.log("Image URL: " + profile.getImageUrl());
    console.log("Email: " + profile.getEmail());
    

    // The ID token you need to pass to your backend:
    var id_token = googleUser.getAuthResponse().id_token;
    console.log("ID Token: " + id_token);
  };
