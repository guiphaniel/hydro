let nbStars = 0;

function showFilmDetails(title, year) {
    document.getElementById('movie-details-container').classList.add('show');

    let content = document.getElementById('movie-details-content');
        
    let url = BASE_URL + API_KEY + '&' + 'query=' + title + '&' + 'year=' + year;

    //TODO: initialiser le nbStars à la moyenne du film
    getMovie(url).then(movieInfo => {
        content.innerHTML = ` 
            <span class="close" onclick="closeFilmDetails()">&times;</span>
            <div id="movie-details">
                <div id="movie">                                
                    <img src="${IMG_URL+movieInfo.poster_path}" alt="${movieInfo.title}">
                    <div id="start-button"></div>
                </div>
                <div id="details">
                    <h2 class="movie-title">${movieInfo.title}</h2>
                    <h2 class="movie-year">${new Date(movieInfo.release_date).toLocaleDateString("FR-fr", { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' })}</h2>
                    <div id="stars">
                        <svg id="star-1" onclick="checkStar('star-1')" aria-hidden="true" focusable="false" data-prefix="fad" data-icon="star" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" class="star"><g class="fa-group"><path fill="currentColor" d="M528.53 171.5l-146.36-21.3-65.43-132.39c-11.71-23.59-45.68-23.89-57.48 0L193.83 150.2 47.47 171.5c-26.27 3.79-36.79 36.08-17.75 54.58l105.91 103-25 145.49c-4.52 26.3 23.22 46 46.48 33.69L288 439.56l130.93 68.69c23.26 12.21 51-7.39 46.48-33.69l-25-145.49 105.91-103c19-18.49 8.48-50.78-17.79-54.57zm-90.89 71l-66.05 64.23 15.63 90.86a12 12 0 0 1-17.4 12.66L288 367.27l-81.82 42.94a12 12 0 0 1-17.4-12.66l15.63-90.86-66-64.23A12 12 0 0 1 145 222l91.34-13.28 40.9-82.81a12 12 0 0 1 21.52 0l40.9 82.81L431 222a12 12 0 0 1 6.64 20.46z" class="star-outer"></path><path fill="currentColor" d="M437.64 242.46l-66.05 64.23 15.63 90.86a12 12 0 0 1-17.4 12.66L288 367.27l-81.82 42.94a12 12 0 0 1-17.4-12.66l15.63-90.86-66-64.23A12 12 0 0 1 145 222l91.34-13.28 40.9-82.81a12 12 0 0 1 21.52 0l40.9 82.81L431 222a12 12 0 0 1 6.64 20.46z" class="star-inner"></path></g></svg>
                        <svg id="star-2" onclick="checkStar('star-2')"aria-hidden="true" focusable="false" data-prefix="fad" data-icon="star" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" class="star"><g class="fa-group"><path fill="currentColor" d="M528.53 171.5l-146.36-21.3-65.43-132.39c-11.71-23.59-45.68-23.89-57.48 0L193.83 150.2 47.47 171.5c-26.27 3.79-36.79 36.08-17.75 54.58l105.91 103-25 145.49c-4.52 26.3 23.22 46 46.48 33.69L288 439.56l130.93 68.69c23.26 12.21 51-7.39 46.48-33.69l-25-145.49 105.91-103c19-18.49 8.48-50.78-17.79-54.57zm-90.89 71l-66.05 64.23 15.63 90.86a12 12 0 0 1-17.4 12.66L288 367.27l-81.82 42.94a12 12 0 0 1-17.4-12.66l15.63-90.86-66-64.23A12 12 0 0 1 145 222l91.34-13.28 40.9-82.81a12 12 0 0 1 21.52 0l40.9 82.81L431 222a12 12 0 0 1 6.64 20.46z" class="star-outer"></path><path fill="currentColor" d="M437.64 242.46l-66.05 64.23 15.63 90.86a12 12 0 0 1-17.4 12.66L288 367.27l-81.82 42.94a12 12 0 0 1-17.4-12.66l15.63-90.86-66-64.23A12 12 0 0 1 145 222l91.34-13.28 40.9-82.81a12 12 0 0 1 21.52 0l40.9 82.81L431 222a12 12 0 0 1 6.64 20.46z" class="star-inner"></path></g></svg>
                        <svg id="star-3" onclick="checkStar('star-3')"aria-hidden="true" focusable="false" data-prefix="fad" data-icon="star" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" class="star"><g class="fa-group"><path fill="currentColor" d="M528.53 171.5l-146.36-21.3-65.43-132.39c-11.71-23.59-45.68-23.89-57.48 0L193.83 150.2 47.47 171.5c-26.27 3.79-36.79 36.08-17.75 54.58l105.91 103-25 145.49c-4.52 26.3 23.22 46 46.48 33.69L288 439.56l130.93 68.69c23.26 12.21 51-7.39 46.48-33.69l-25-145.49 105.91-103c19-18.49 8.48-50.78-17.79-54.57zm-90.89 71l-66.05 64.23 15.63 90.86a12 12 0 0 1-17.4 12.66L288 367.27l-81.82 42.94a12 12 0 0 1-17.4-12.66l15.63-90.86-66-64.23A12 12 0 0 1 145 222l91.34-13.28 40.9-82.81a12 12 0 0 1 21.52 0l40.9 82.81L431 222a12 12 0 0 1 6.64 20.46z" class="star-outer"></path><path fill="currentColor" d="M437.64 242.46l-66.05 64.23 15.63 90.86a12 12 0 0 1-17.4 12.66L288 367.27l-81.82 42.94a12 12 0 0 1-17.4-12.66l15.63-90.86-66-64.23A12 12 0 0 1 145 222l91.34-13.28 40.9-82.81a12 12 0 0 1 21.52 0l40.9 82.81L431 222a12 12 0 0 1 6.64 20.46z" class="star-inner"></path></g></svg>
                        <svg id="star-4" onclick="checkStar('star-4')"aria-hidden="true" focusable="false" data-prefix="fad" data-icon="star" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" class="star"><g class="fa-group"><path fill="currentColor" d="M528.53 171.5l-146.36-21.3-65.43-132.39c-11.71-23.59-45.68-23.89-57.48 0L193.83 150.2 47.47 171.5c-26.27 3.79-36.79 36.08-17.75 54.58l105.91 103-25 145.49c-4.52 26.3 23.22 46 46.48 33.69L288 439.56l130.93 68.69c23.26 12.21 51-7.39 46.48-33.69l-25-145.49 105.91-103c19-18.49 8.48-50.78-17.79-54.57zm-90.89 71l-66.05 64.23 15.63 90.86a12 12 0 0 1-17.4 12.66L288 367.27l-81.82 42.94a12 12 0 0 1-17.4-12.66l15.63-90.86-66-64.23A12 12 0 0 1 145 222l91.34-13.28 40.9-82.81a12 12 0 0 1 21.52 0l40.9 82.81L431 222a12 12 0 0 1 6.64 20.46z" class="star-outer"></path><path fill="currentColor" d="M437.64 242.46l-66.05 64.23 15.63 90.86a12 12 0 0 1-17.4 12.66L288 367.27l-81.82 42.94a12 12 0 0 1-17.4-12.66l15.63-90.86-66-64.23A12 12 0 0 1 145 222l91.34-13.28 40.9-82.81a12 12 0 0 1 21.52 0l40.9 82.81L431 222a12 12 0 0 1 6.64 20.46z" class="star-inner"></path></g></svg>
                        <svg id="star-5" onclick="checkStar('star-5')"aria-hidden="true" focusable="false" data-prefix="fad" data-icon="star" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" class="star"><g class="fa-group"><path fill="currentColor" d="M528.53 171.5l-146.36-21.3-65.43-132.39c-11.71-23.59-45.68-23.89-57.48 0L193.83 150.2 47.47 171.5c-26.27 3.79-36.79 36.08-17.75 54.58l105.91 103-25 145.49c-4.52 26.3 23.22 46 46.48 33.69L288 439.56l130.93 68.69c23.26 12.21 51-7.39 46.48-33.69l-25-145.49 105.91-103c19-18.49 8.48-50.78-17.79-54.57zm-90.89 71l-66.05 64.23 15.63 90.86a12 12 0 0 1-17.4 12.66L288 367.27l-81.82 42.94a12 12 0 0 1-17.4-12.66l15.63-90.86-66-64.23A12 12 0 0 1 145 222l91.34-13.28 40.9-82.81a12 12 0 0 1 21.52 0l40.9 82.81L431 222a12 12 0 0 1 6.64 20.46z" class="star-outer"></path><path fill="currentColor" d="M437.64 242.46l-66.05 64.23 15.63 90.86a12 12 0 0 1-17.4 12.66L288 367.27l-81.82 42.94a12 12 0 0 1-17.4-12.66l15.63-90.86-66-64.23A12 12 0 0 1 145 222l91.34-13.28 40.9-82.81a12 12 0 0 1 21.52 0l40.9 82.81L431 222a12 12 0 0 1 6.64 20.46z" class="star-inner"></path></g></svg>
                    </div>
                    <p>${movieInfo.overview}</p>
                    <p>genres</p>
                    <p>Realisateur</p>
                    <div id="actors">

                    </div>
                </div>
            </div>
            <div id="movie-recommendations">

            </div> 
        `;
    });
}

function closeFilmDetails() {
    document.getElementById('movie-details-container').classList.remove('show');
}

const API_KEY = 'api_key=0cbdab6dfb9d5c3d8b7a3cf506e11b83'
const BASE_URL = 'https://api.themoviedb.org/3/search/movie?'
const IMG_URL = 'https://image.tmdb.org/t/p/w500/'

function getMovie(url) {
    return fetch(url).then(res => res.json()).then(data => { 
        let movie = {title: null, release_date: null, poster_path: null, overview: null}
        movie.title = data.results[0]['title']
        movie.release_date = data.results[0]['release_date']
        movie.poster_path = data.results[0]['poster_path']
        movie.overview = data.results[0]['overview']        
        return movie 
    })  
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


function checkStar(starID) {
    newNbStars = starID.substring(5)

    if (newNbStars < nbStars) {
        for (let index = nbStars; index > newNbStars; index--) {
            document.getElementById('star-' + index).classList.remove("star-is-checked");
        }
    } else if(newNbStars > nbStars) {
        for (let index = parseInt(nbStars) + 1; index <= newNbStars; index++) {
            document.getElementById('star-' + index).classList.add("star-is-checked");
        }
    } else {
        return;
    }

    nbStars = newNbStars
}

//new Date(movieInfo.release_date)