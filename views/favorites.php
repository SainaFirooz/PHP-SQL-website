<main class="container mx-auto p-4 flex-grow flex flex-col justify-center items-center">
    <h2 class="text-2xl font-bold mb-4">Your Favorites</h2>
    <?php if (!empty($favorites)): ?>
        <ul class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 w-full max-w-4xl">
            <?php foreach ($favorites as $favorite): ?>
                <?php
                    // Hämtar TMDb-id för favoriten och sätter API-nyckeln
                    $tmdb_id = htmlspecialchars($favorite['tmdb_id']);
                    $api_key = '993bbff5d53305eb36820314cdecdc36'; 
                    // Hämtar poster_path för favorit filmerna
                    $url = "https://api.themoviedb.org/3/movie/$tmdb_id?api_key=$api_key";
                    $response = @file_get_contents($url);
                    $poster_path = '';

                    if ($response !== false) {
                        $movie_details = json_decode($response, true);
                        $poster_path = $movie_details['poster_path'] ?? '';
                    }
                ?>
                <li class="card bg-white shadow-md p-4">
                    <?php if (!empty($poster_path)): ?>
                        <img src="https://image.tmdb.org/t/p/w500<?php echo htmlspecialchars($poster_path); ?>" alt="<?php echo htmlspecialchars($favorite['title']); ?> poster" class="rounded">
                    <?php else: ?>
                        <img src="placeholder_image.jpg" alt="No poster available" class="rounded">
                    <?php endif; ?>
                    <p class="mt-2 font-bold"><?php echo htmlspecialchars($favorite['title']); ?></p>
                    <form method="post" action="index.php?page=removeFavorite" class="mt-2">
                        <input type="hidden" name="favorite_id" value="<?php echo htmlspecialchars($favorite['id']); ?>">
                        <button type="submit" class="btn btn-active">Remove</button>
                    </form>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>No favorite movies available.</p>
    <?php endif; ?>
</main>