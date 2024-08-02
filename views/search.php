<main class="container mx-auto p-4 flex-grow flex flex-col justify-center items-center">
    <h2 class="text-2xl font-bold mb-4">Search Results</h2>
    <?php if (!empty($results['results'])): ?>
        <ul class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 w-full max-w-4xl">
            <?php foreach ($results['results'] as $movie): ?>
                <li class="card bg-white shadow-md p-4">
                    <?php if (!empty($movie['poster_path'])): ?>
                        <img src="https://image.tmdb.org/t/p/w500<?php echo htmlspecialchars($movie['poster_path']); ?>" alt="<?php echo htmlspecialchars($movie['title']); ?> poster" class="rounded">
                    <?php else: ?>
                        <img src="path_to_placeholder_image.jpg" alt="No poster available" class="rounded">
                    <?php endif; ?>
                    <p class="mt-2 font-bold"><?php echo htmlspecialchars($movie['title']); ?> 
                    <!-- Kontroll om användaren är inloggad för att visa "Add to Favorites"-knapp -->
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <form method="post" action="index.php?page=addFavorite" class="mt-2">
                            <input type="hidden" name="tmdb_id" value="<?php echo htmlspecialchars($movie['id']); ?>">
                            <input type="hidden" name="title" value="<?php echo htmlspecialchars($movie['title']); ?>">
                            <input type="hidden" name="type" value="movie">
                            <button type="submit" class="btn btn-primary">Add to Favorites</button>
                        </form>
                    <?php endif; ?>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>No results found for your search.</p>
    <?php endif; ?>
</main>