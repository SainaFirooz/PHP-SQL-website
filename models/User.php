<?php
// Skapar en klass för att hantera användare
class User {
    private $conn;
    private $table_name = "Users";

    public $id;
    public $username;
    public $password;
    public $email;

    // skapa en constructor för klassen
    public function __construct($db) {
        $this->conn = $db;
    }

    // metod för att skapa en användare
    public function create() {
        // SQL-fråga för att skapa en användare
        $query = "INSERT INTO " . $this->table_name . " SET username=:username, password=:password, email=:email";
        $stmt = $this->conn->prepare($query);

        // hashar lösenordet
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);

        // binder parametrar till SQL-frågan
        $stmt->bindParam(":username", $this->username);
        $stmt->bindParam(":password", $this->password);
        $stmt->bindParam(":email", $this->email);

        if($stmt->execute()) {
            return true;
        }

        return false;
    }

    // metod för att logga in en användare
    public function login() {
        // SQL-fråga för att hämta användare
        $query = "SELECT id, username, password FROM " . $this->table_name . " WHERE username = :username";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":username", $this->username);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // verifierar lösenordet och startar en session
        if($row && password_verify($this->password, $row['password'])) {
            session_start();
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['username'] = $row['username'];
            return true;
        }

        return false;
    }
}
?>
