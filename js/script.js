const API_KEY = 'api_key=0cbdab6dfb9d5c3d8b7a3cf506e11b83'
const BASE_URL = 'https://api.themoviedb.org/3/search/movie?'
const IMG_URL = 'https://image.tmdb.org/t/p/w500/'
let nbStars;

function showFilmDetails(idMovie, title, year, genres) {
    nbStars = 0;
    document.getElementById('movie-details-container').classList.add('show'); //affichage

    let content = document.getElementById('movie-details-content'); //recuperation du contenu
  
    //recupération de la note moyenne
    let rating = 0.0;
    let xhr = new XMLHttpRequest();
    xhr.open('POST', '../processing/process_get_rate.php');
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function () { //lorsque la moyenne a ete recuperee, on affiche le modal
        if (xhr.status === 200) {
            //File(s) uploaded
            rating = xhr.responseText;

            let url = BASE_URL + API_KEY + '&' + 'query=' + title + '&' + 'year=' + year; //creation de l'url tmdb

            //on imbrique les then car on ne peut pas modifier de variable externe ni faire de return dedans
            getMovie(url).then(movieInfo => {        
                getCredits(movieInfo.id).then(credits => {
                    let actorsHTML = ""
                    try {
                        for (let index = 0; index < 10; index++) {
                            let actor = credits[index]   
                            let actorProfile;
                            if(actor["profile_path"] != null)
                                actorProfile = IMG_URL + actor["profile_path"];
                            else
                                actorProfile = '/img/default-profile.jpg'

                            actorsHTML += `
                                <div class="actor">                                
                                    <div class="actor-img" style="background-image: url('${actorProfile}')" alt="${actor["name"]}"></div>
                                    <p class="actor-name">${actor["name"]} <br> ${actor["character"]}</p>
                                </div>
                                `
                        }
                    } catch(error) {
                        //il y a moins de 10 acteurs
                    } finally {
                        content.innerHTML = ` 
                    <span class="close" onclick="closeFilmDetails()">&times;</span>
                    <div id="movie-details">
                        <div id="movie">                                
                            <img src="${IMG_URL+movieInfo.poster_path}" alt="${movieInfo.title}">
                            <div id="start-button" class="button" onclick="playMovie('${window.encodeURIComponent(movieInfo.title) + "film bande annonce"}')">Regarder</div>
                        </div>
                        <div id="details">
                            <h2 class="movie-title">${movieInfo.title}</h2>
                            <h3 class="movie-year">${new Date(movieInfo.release_date).toLocaleDateString("FR-fr", { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' })}</h3>
                            <div id="stars">
                                <p id="avg-rating">${parseFloat(rating).toFixed(1)}</p>
                                <svg id="star-1" onclick="saveRating('1', ${idMovie})" aria-hidden="true" focusable="false" data-prefix="fad" data-icon="star" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" class="star"><g class="fa-group"><path fill="currentColor" d="M528.53 171.5l-146.36-21.3-65.43-132.39c-11.71-23.59-45.68-23.89-57.48 0L193.83 150.2 47.47 171.5c-26.27 3.79-36.79 36.08-17.75 54.58l105.91 103-25 145.49c-4.52 26.3 23.22 46 46.48 33.69L288 439.56l130.93 68.69c23.26 12.21 51-7.39 46.48-33.69l-25-145.49 105.91-103c19-18.49 8.48-50.78-17.79-54.57zm-90.89 71l-66.05 64.23 15.63 90.86a12 12 0 0 1-17.4 12.66L288 367.27l-81.82 42.94a12 12 0 0 1-17.4-12.66l15.63-90.86-66-64.23A12 12 0 0 1 145 222l91.34-13.28 40.9-82.81a12 12 0 0 1 21.52 0l40.9 82.81L431 222a12 12 0 0 1 6.64 20.46z" class="star-outer"></path><path fill="currentColor" d="M437.64 242.46l-66.05 64.23 15.63 90.86a12 12 0 0 1-17.4 12.66L288 367.27l-81.82 42.94a12 12 0 0 1-17.4-12.66l15.63-90.86-66-64.23A12 12 0 0 1 145 222l91.34-13.28 40.9-82.81a12 12 0 0 1 21.52 0l40.9 82.81L431 222a12 12 0 0 1 6.64 20.46z" class="star-inner"></path></g></svg>
                                <svg id="star-2" onclick="saveRating('2', ${idMovie})" aria-hidden="true" focusable="false" data-prefix="fad" data-icon="star" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" class="star"><g class="fa-group"><path fill="currentColor" d="M528.53 171.5l-146.36-21.3-65.43-132.39c-11.71-23.59-45.68-23.89-57.48 0L193.83 150.2 47.47 171.5c-26.27 3.79-36.79 36.08-17.75 54.58l105.91 103-25 145.49c-4.52 26.3 23.22 46 46.48 33.69L288 439.56l130.93 68.69c23.26 12.21 51-7.39 46.48-33.69l-25-145.49 105.91-103c19-18.49 8.48-50.78-17.79-54.57zm-90.89 71l-66.05 64.23 15.63 90.86a12 12 0 0 1-17.4 12.66L288 367.27l-81.82 42.94a12 12 0 0 1-17.4-12.66l15.63-90.86-66-64.23A12 12 0 0 1 145 222l91.34-13.28 40.9-82.81a12 12 0 0 1 21.52 0l40.9 82.81L431 222a12 12 0 0 1 6.64 20.46z" class="star-outer"></path><path fill="currentColor" d="M437.64 242.46l-66.05 64.23 15.63 90.86a12 12 0 0 1-17.4 12.66L288 367.27l-81.82 42.94a12 12 0 0 1-17.4-12.66l15.63-90.86-66-64.23A12 12 0 0 1 145 222l91.34-13.28 40.9-82.81a12 12 0 0 1 21.52 0l40.9 82.81L431 222a12 12 0 0 1 6.64 20.46z" class="star-inner"></path></g></svg>
                                <svg id="star-3" onclick="saveRating('3', ${idMovie})" aria-hidden="true" focusable="false" data-prefix="fad" data-icon="star" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" class="star"><g class="fa-group"><path fill="currentColor" d="M528.53 171.5l-146.36-21.3-65.43-132.39c-11.71-23.59-45.68-23.89-57.48 0L193.83 150.2 47.47 171.5c-26.27 3.79-36.79 36.08-17.75 54.58l105.91 103-25 145.49c-4.52 26.3 23.22 46 46.48 33.69L288 439.56l130.93 68.69c23.26 12.21 51-7.39 46.48-33.69l-25-145.49 105.91-103c19-18.49 8.48-50.78-17.79-54.57zm-90.89 71l-66.05 64.23 15.63 90.86a12 12 0 0 1-17.4 12.66L288 367.27l-81.82 42.94a12 12 0 0 1-17.4-12.66l15.63-90.86-66-64.23A12 12 0 0 1 145 222l91.34-13.28 40.9-82.81a12 12 0 0 1 21.52 0l40.9 82.81L431 222a12 12 0 0 1 6.64 20.46z" class="star-outer"></path><path fill="currentColor" d="M437.64 242.46l-66.05 64.23 15.63 90.86a12 12 0 0 1-17.4 12.66L288 367.27l-81.82 42.94a12 12 0 0 1-17.4-12.66l15.63-90.86-66-64.23A12 12 0 0 1 145 222l91.34-13.28 40.9-82.81a12 12 0 0 1 21.52 0l40.9 82.81L431 222a12 12 0 0 1 6.64 20.46z" class="star-inner"></path></g></svg>
                                <svg id="star-4" onclick="saveRating('4', ${idMovie})" aria-hidden="true" focusable="false" data-prefix="fad" data-icon="star" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" class="star"><g class="fa-group"><path fill="currentColor" d="M528.53 171.5l-146.36-21.3-65.43-132.39c-11.71-23.59-45.68-23.89-57.48 0L193.83 150.2 47.47 171.5c-26.27 3.79-36.79 36.08-17.75 54.58l105.91 103-25 145.49c-4.52 26.3 23.22 46 46.48 33.69L288 439.56l130.93 68.69c23.26 12.21 51-7.39 46.48-33.69l-25-145.49 105.91-103c19-18.49 8.48-50.78-17.79-54.57zm-90.89 71l-66.05 64.23 15.63 90.86a12 12 0 0 1-17.4 12.66L288 367.27l-81.82 42.94a12 12 0 0 1-17.4-12.66l15.63-90.86-66-64.23A12 12 0 0 1 145 222l91.34-13.28 40.9-82.81a12 12 0 0 1 21.52 0l40.9 82.81L431 222a12 12 0 0 1 6.64 20.46z" class="star-outer"></path><path fill="currentColor" d="M437.64 242.46l-66.05 64.23 15.63 90.86a12 12 0 0 1-17.4 12.66L288 367.27l-81.82 42.94a12 12 0 0 1-17.4-12.66l15.63-90.86-66-64.23A12 12 0 0 1 145 222l91.34-13.28 40.9-82.81a12 12 0 0 1 21.52 0l40.9 82.81L431 222a12 12 0 0 1 6.64 20.46z" class="star-inner"></path></g></svg>
                                <svg id="star-5" onclick="saveRating('5', ${idMovie})" aria-hidden="true" focusable="false" data-prefix="fad" data-icon="star" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" class="star"><g class="fa-group"><path fill="currentColor" d="M528.53 171.5l-146.36-21.3-65.43-132.39c-11.71-23.59-45.68-23.89-57.48 0L193.83 150.2 47.47 171.5c-26.27 3.79-36.79 36.08-17.75 54.58l105.91 103-25 145.49c-4.52 26.3 23.22 46 46.48 33.69L288 439.56l130.93 68.69c23.26 12.21 51-7.39 46.48-33.69l-25-145.49 105.91-103c19-18.49 8.48-50.78-17.79-54.57zm-90.89 71l-66.05 64.23 15.63 90.86a12 12 0 0 1-17.4 12.66L288 367.27l-81.82 42.94a12 12 0 0 1-17.4-12.66l15.63-90.86-66-64.23A12 12 0 0 1 145 222l91.34-13.28 40.9-82.81a12 12 0 0 1 21.52 0l40.9 82.81L431 222a12 12 0 0 1 6.64 20.46z" class="star-outer"></path><path fill="currentColor" d="M437.64 242.46l-66.05 64.23 15.63 90.86a12 12 0 0 1-17.4 12.66L288 367.27l-81.82 42.94a12 12 0 0 1-17.4-12.66l15.63-90.86-66-64.23A12 12 0 0 1 145 222l91.34-13.28 40.9-82.81a12 12 0 0 1 21.52 0l40.9 82.81L431 222a12 12 0 0 1 6.64 20.46z" class="star-inner"></path></g></svg>
                            </div>
                            <p>${movieInfo.overview}</p>
                            <p id="genres">${genres}</p>
                            <div id="actors">
                                ${actorsHTML}
                            </div>
                        </div>
                    </div> 
                `;
                    updateUserRating(idMovie);
                    }
                });
            });
        } else {
            alert('An error occurred!');
        }
    };
    let parameters = 'idMovie=' + window.encodeURIComponent(idMovie);
    xhr.send(parameters);
}

function closeFilmDetails() {
    document.getElementById('movie-details-container').classList.remove('show');
}


function getMovie(url) {
    return fetch(url).then(res => res.json()).then(data => { 
        let movie = {id: null, title: null, release_date: null, poster_path: null, overview: null}
        movie.id = data.results[0]['id']
        movie.title = data.results[0]['title']
        movie.release_date = data.results[0]['release_date']
        movie.poster_path = data.results[0]['poster_path']
        movie.overview = data.results[0]['overview']        
        return movie 
    })  
}

function getCredits(id){
    //let content = document.getElementById('movie-details-content');
        
    let url = "https://api.themoviedb.org/3/movie/" + id +"/credits?" + API_KEY;

    return fetch(url).then(res => res.json()).then(data => data["cast"])
}
 
function showMovie(htmlId, title, year) {
    let movie = document.getElementById(htmlId);
        
    let url = BASE_URL + API_KEY + '&' + 'query=' + title + '&' + 'year=' + year;

    getMovie(url).then(movieInfo => {
        movie.innerHTML = ` 
            <img src="${IMG_URL+movieInfo.poster_path}" alt="${movieInfo.title}">
            <figcaption>${movieInfo.title} <br> ${year}</figcaption>
        `;
    });
}

function playMovie(title){
    let youtube_API_key = "AIzaSyAW39vDkJUI95mQVE0b0w_rfP2pHpzmkQA";
    let fetchUrl = "https://www.googleapis.com/youtube/v3/search?key=" + youtube_API_key + "&q=" + title;

    fetch(fetchUrl).then(res => res.json()).then(data => { 
        let videoId = data.items[0].id.videoId;        
        let videoUrl = "https://www.youtube.com/embed/" + videoId;

        window.open(videoUrl, '_blank').focus();
    })
}

function setUserRating(starID) { //onclick, set rating and display it
    if (starID < nbStars) {
        for (let index = nbStars; index > starID; index--) {
            document.getElementById('star-' + index).classList.remove("star-is-checked");
        }
    } else if(starID > nbStars) {
        for (let index = parseInt(nbStars) + 1; index <= starID; index++) {
            document.getElementById('star-' + index).classList.add("star-is-checked");
        }
    } else {
        return;
    }

    nbStars = starID
}

function updateUserRating(idMovie){ //retrieve the user rating from db, and display it
    let xhr = new XMLHttpRequest();
    xhr.open('POST', '../processing/process_get_user_rate.php');
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function () {
        if (xhr.status === 200) {
            rating = parseFloat(xhr.responseText).toFixed(0);
            setUserRating(rating);
        } else {
            alert('An error occurred!');
        }
    };

    let parameters = 'idMovie=' + window.encodeURIComponent(idMovie);
    xhr.send(parameters);
}

function saveRating(starID, idMovie) {
    setUserRating(starID);

    //recupération de la note moyenne
    let rating = starID;
    let xhr = new XMLHttpRequest();
    xhr.open('POST', '../processing/process_save_rate.php');
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    //une fois sauvegarde, on actualise la note moyenne
    xhr.onload = function () {
        xhr.responseText;
        let xhrGet = new XMLHttpRequest();
        xhrGet.open('POST', '../processing/process_get_rate.php');
        xhrGet.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhrGet.onload = function () { //stockage de la valeur retournee
            if (xhrGet.status === 200) {
                let avgRating = document.getElementById('avg-rating');
                avgRating.innerHTML = parseFloat(xhrGet.responseText).toFixed(1);
            } else {
                alert('An error occurred!');
            }
        };
        let parameters = 'idMovie=' + window.encodeURIComponent(idMovie);
        xhrGet.send(parameters);        
    };
    let parameters = 'idMovie=' + window.encodeURIComponent(idMovie) + '&rating=' + window.encodeURIComponent(rating);
    xhr.send(parameters);
}

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
    try {
        var auth2 = gapi.auth2.getAuthInstance();
        auth2.signOut().then(function () {
        });
        auth2.disconnect();
    } catch (error) {
        
    }
    document.location.href="../processing/process_sign_out.php"
    
  }

function onSignIn(googleUser) {
    // Useful data for your client-side scripts:
    let profile = googleUser.getBasicProfile();

    // The ID token you need to pass to your backend:
    let id_token = googleUser.getAuthResponse().id_token;
    let xhr = new XMLHttpRequest();
    xhr.open('POST', '../processing/process_google_sign.php');
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
    console.log('Signed in as: ' + xhr.responseText);
    };
    xhr.send('idtoken='+id_token);
    document.location.href="../catalogue.php"
};
