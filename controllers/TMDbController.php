<?php
// inkluderar API modellen
require_once 'models/TMDbAPI.php';

// skapar en TMDb controller class
class TMDbController {
    private $tmdb;

    // skapar en constructor för klassen
    public function __construct() {
        $this->tmdb = new TMDbAPI();
    }

    // metod för att söka efter filmer
    public function search() {
        // hämtar och sanerar sökfrågan
        $query = filter_input(INPUT_GET, 'query', FILTER_SANITIZE_STRING);

        // söker efter filmer med TMDb API
        if ($query) {
            $results = $this->tmdb->searchMovie($query);

            
            include 'views/partials/header.php';
            include 'views/search.php';
            include 'views/partials/footer.php';
        } else {
            header("Location: index.php");
        }
    }
}
?>
