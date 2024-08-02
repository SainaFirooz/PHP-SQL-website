<?php
// inkluderar viktiga filer
require_once 'config/Database.php';
require_once 'models/Favorite.php';

// skapar en favorit controller class
class FavoriteController {
    private $db; 
    private $favorite; 
    
    // skapar en constructor för klassen
    public function __construct() {
        // skapar en ny databas anslutning
        $database = new Database();
        $this->db = $database->getConnection();
        // skapar en ny favorit och skickar den till databasen
        $this->favorite = new Favorite($this->db);
    }

    // hämtar alla favoriter för en användare
    public function index() {
        // Kontrollerar om användaren är inloggad
        if (isset($_SESSION['user_id'])) {
            $this->favorite->user_id = $_SESSION['user_id'];
            // Hämtar användarens favoriter
            $favorites = $this->favorite->getFavorites();
            
            include 'views/partials/header.php';
            include 'views/favorites.php';
            include 'views/partials/footer.php';
        } else {
            // Om användaren inte är inloggad, skicka till login sidan
            header("Location: index.php?page=login");
        }
    }
   
    // lägger till en favorit
    public function addFavorite() {
        // Kontrollerar om användaren är inloggad
        if ($_POST && isset($_SESSION['user_id'])) {
            $this->favorite->user_id = $_SESSION['user_id'];
            $this->favorite->tmdb_id = $_POST['tmdb_id'];
            $this->favorite->title = $_POST['title'];
            $this->favorite->type = $_POST['type'];
            
            // Försöker lägga till favoriten i databasen
            if ($this->favorite->addFavorite()) {
                header("Location: index.php?page=favorites");
            } else {
                echo "Unable to add movie to your favorites.";
            }
        } else {
            header("Location: index.php?page=login");
        }
    }

    // tar bort en favorit
    public function removeFavorite() {
        // Kontrollerar om användaren är inloggad
        if ($_POST && isset($_SESSION['user_id'])) {
            $this->favorite->id = $_POST['favorite_id'];
            
            // Försöker ta bort favoriten från databasen
            if ($this->favorite->removeFavorite()) {
                header("Location: index.php?page=favorites");
            } else {
                echo "Unable to remove movie from your favorites.";
            }
        } else {
            header("Location: index.php?page=login");
        }
    }
}
?>
