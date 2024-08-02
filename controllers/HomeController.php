<?php
// inkluderar API modellen
require_once 'models/TMDbAPI.php';

class HomeController {
    private $tmdb; 

    // skapar en constructor för klassen
    public function __construct() {
        // skapar en ny instans av TMDbAPI
        $this->tmdb = new TMDbAPI();
    }

    // hämtar trending movies som ska visas i home.php
    public function index() {
        $trendingMovies = $this->tmdb->getTrendingMovies();
        
        include 'views/partials/header.php';
        include 'views/home.php';
        include 'views/partials/footer.php';
    }
}
?>
