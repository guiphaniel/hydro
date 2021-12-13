function showFilmDetails(title, year) {
    document.getElementById('movie-details-container').classList.add('show');

    let content = document.getElementById('movie-details-content');
        
    let url = BASE_URL + API_KEY + '&' + 'query=' + title + '&' + 'year=' + year;

    getMovie(url).then(movieInfo => {
        content.innerHTML = ` 
            <span class="close" onclick="closeFilmDetails('<?=$movieTitle?>', '<?=$movieYear?>')">&times;</span>
            <h2>${movieInfo.title}</h2>
            <h2>${year}</h2>
            <div id="movie-description">
                <img id="details-img" src="${IMG_URL+movieInfo.poster_path}" alt="${movieInfo.title}">
                <p>${movieInfo.overview}</p>
            </div>
            <div id="actors">
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

//new Date(movieInfo.release_date)