<?php
// skapar en klass för att hantera API-anrop till TMDb API
class TMDbAPI {
    // API-nyckel och Bearer token
    private $api_key = "993bbff5d53305eb36820314cdecdc36";  
    private $bearer_token = "eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiI5OTNiYmZmNWQ1MzMwNWViMzY4MjAzMTRjZGVjZGMzNiIsIm5iZiI6MTcyMjQ1ODg4OC4yNTAzNzEsInN1YiI6IjY2OTU2YjhiYzcwNzM2YzRkMjQ2YjEwOSIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.1ILV_iNO0zuGNbePDkcOtFxzWPfkpUGMXPupnyvyQD0";  // Replace with your actual Bearer token
    // Metod för att söka efter filmer
    public function searchMovie($query) {
        $url = "https://api.themoviedb.org/3/search/movie?include_adult=false&language=en-US&page=1&query=" . urlencode($query);
        return $this->makeRequest($url);
    }

    // Metod för att hämta trending movies
    public function getTrendingMovies() {
        $url = "https://api.themoviedb.org/3/trending/movie/day";
        return $this->makeRequest($url);
    }

    // Privat metod för att göra en API-förfrågan, tog detta från API sidan
    private function makeRequest($url) {
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => [
                "Authorization: Bearer " . $this->bearer_token,
                "accept: application/json"
            ],
            /* behövde Inaktiverar SSL-verifiering då jag fick lite problem
            vet att det gör allt osäkrare men det var det enda
             sättet jag kunde få det att fungera */
            CURLOPT_SSL_VERIFYPEER => false,  
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            die("cURL Error #:" . $err);
        } else {
            return json_decode($response, true);
        }
    }
}
?>
