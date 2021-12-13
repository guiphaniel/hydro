
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
function signOut() {
    var auth2 = gapi.auth2.getAuthInstance();
    auth2.signOut().then(function () {
    });
    auth2.disconnect();
  }

function onSignIn(googleUser) {
    // Useful data for your client-side scripts:
    var profile = googleUser.getBasicProfile();

    // The ID token you need to pass to your backend:
    var id_token = googleUser.getAuthResponse().id_token;
    var xhr = new XMLHttpRequest();
    xhr.open('POST', '../processing/process_google_sign.php');
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
    console.log('Signed in as: ' + xhr.responseText);
    };
    xhr.send('idtoken='+id_token);
    
};
