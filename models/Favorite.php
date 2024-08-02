<?php

// Skapar en klass för att hantera favoritobjekt
class Favorite {
    private $conn;
    private $table_name = "Favorites";
    public $id;
    public $user_id;
    public $tmdb_id;
    public $title;
    public $type;

    // Konstruktor som tar en databasanslutning som parameter
    public function __construct($db) {
        $this->conn = $db;
    }

    // Metod för att lägga till en favorit i databasen
    public function addFavorite() {
         // SQL-fråga för att lägga till en favorit
        $query = "INSERT INTO " . $this->table_name . " SET user_id=:user_id, tmdb_id=:tmdb_id, title=:title, type=:type";
        $stmt = $this->conn->prepare($query);

        // Binder parametrar till SQL-frågan
        $stmt->bindParam(":user_id", $this->user_id);
        $stmt->bindParam(":tmdb_id", $this->tmdb_id);
        $stmt->bindParam(":title", $this->title);
        $stmt->bindParam(":type", $this->type);

        if($stmt->execute()) {
            return true;
        }

        return false;
    }

    // Metod för att ta bort en favorit från databasen
    public function removeFavorite() {
        // SQL-fråga för att ta bort en favorit
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);

         // Binder id-parametern till SQL-frågan
        $stmt->bindParam(":id", $this->id);

        if($stmt->execute()) {
            return true;
        }

        return false;
    }

    // Metod för att hämta alla favoriter för en specifik användare
    public function getFavorites() {
        // SQL-fråga för att hämta favoriter baserat på user_id
        $query = "SELECT * FROM " . $this->table_name . " WHERE user_id = :user_id";
        $stmt = $this->conn->prepare($query);

        // Binder user_id-parametern till SQL-frågan
        $stmt->bindParam(":user_id", $this->user_id);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
