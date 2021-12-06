function showFilmDetails(movieid) {
    document.getElementById('movie-details-container').classList.add('show');
}

function hideFilmDetails() {
    document.getElementById('movie-details-container').classList.remove('show');
}

const API_KEY = 'api_key=0cbdab6dfb9d5c3d8b7a3cf506e11b83'
const BASE_URL = 'https://api.themoviedb.org/3/search/movie?'
const IMG_URL = 'https://image.tmdb.org/t/p/w500/'

//test();
showMovies();

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
 
function showMovies() {
    let movies = document.getElementsByClassName("movie-tile");

    for (let movie of movies) {
        let id = movie.id.substring(5); 
        
        let localTitle = "Star Wars"
        let year = 2010;
        let url = BASE_URL + API_KEY + '&' + 'query=' + localTitle + '&' + 'year=' + year;

        getMovie(url).then(movieInfo => {
            movie.innerHTML = `
                <img src="${IMG_URL+movieInfo.poster_path}" alt="${movieInfo.title}">
                <figcaption>${movieInfo.title} <br> ${movieInfo.release_date}</figcaption>
            `;
        });
    }
}

function createObject(){
    let o = {foo: null, bar: null};
    o.foo = 5;
    return o;
}

function test(){
    let o = createObject();
    o.bar = 1;
    console.log(o.foo);
    console.log(o.bar);
}