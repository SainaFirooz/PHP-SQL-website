<?php
// inkluderar databasen och användarmodellen
require_once 'config/Database.php';
require_once 'models/User.php';

// skapar en user controller klass
class UserController {
    private $db;
    private $user;

    // skapar en constructor för klassen
    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->user = new User($this->db);
    }

    // metod för att registrera en användare
    public function register() {
        // kontrollerar om det finns POST-data
        if ($_POST) {
            // sanerar användarnamn, lösenord och email
            $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
            $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
            $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
            
            // kontrollerar om alla fält är giltiga
            if ($username && $password && $email) {
                // sätter användarnamn, lösenord och email
                $this->user->username = $username;
                // hashar lösenordet
                $this->user->password = password_hash($password, PASSWORD_BCRYPT);
                $this->user->email = $email;

                // försöker skapa användaren
                if ($this->user->create()) {
                    header("Location: index.php?page=login");
                } else {
                    echo "Unable to register user.";
                }
            } else {
                echo "Invalid input.";
            }
        }
  
       
        include 'views/partials/header.php';
        include 'views/register.php';
        include 'views/partials/footer.php';
    }

    // metod för att logga in en användare
    public function login() {
        // kontrollerar om det finns POST-data
        if ($_POST) {
            // sanerar användarnamn och lösenord
            $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
            $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

            // kontrollerar om användarnamn och lösenord är giltiga
            if ($username && $password) {
                $this->user->username = $username;
                $this->user->password = $password;

                // försöker logga in användaren
                if ($this->user->login()) {
                    header("Location: index.php?page=favorites");
                } else {
                    echo "Login failed.";
                }
            } else {
                echo "Invalid input.";
            }
        }

        include 'views/partials/header.php';
        include 'views/login.php';
        include 'views/partials/footer.php';
    }

    // metod för att logga ut en användare
    public function logout() {
        session_start();
        session_unset();
        session_destroy();
        header("Location: index.php?page=login");
    }
}
?>
