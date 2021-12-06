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


function showMovies() {
    let movies = document.getElementsByClassName("movie-tile");

    for (let movie of movies) {
        let id = movie.id.substring(5); 
        
        let localTitle = "Star Wars"
        let year = 2010;
        let url = BASE_URL + API_KEY + '&' + 'query=' + localTitle + '&' + 'year=' + year;
        
        getMovie(id, url);
        /*console.log(movieInfo['']);*/
        /*
        movie.innerHTML = `
        <img src="${IMG_URL+movieInfo['poster_path']}" alt="${movieInfo['title']}">
        <figcaption>${movieInfo['title']} <br> ${movieInfo['release_date']}</figcaption>
        `;*/
    }
}

function getMovie(id, url) {
    let test;
    fetch(url).then(res => res.json()).then(data => { 
        test = data.results[0].poster_path;
        updateMovie(id, test);
    })  
}

function updateMovie(id, test) {
    console.log(test);
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