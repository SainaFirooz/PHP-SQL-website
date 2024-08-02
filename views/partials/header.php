<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cinephiles</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/daisyui@1.14.2/dist/full.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex flex-col min-h-screen">
    <header class="bg-base-300 text-base-content p-4">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-3xl font-bold"><a href="index.php">Cinephile</a></h1>
            <nav>
            <ul class="flex space-x-4">
                    <li><a href="index.php" class="btn btn-ghost btn-sm rounded-btn">Home</a></li>
                    <li><a href="index.php?page=favorites" class="btn btn-ghost btn-sm rounded-btn">Favorites</a></li>
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <li><a href="index.php?page=logout" class="btn btn-ghost btn-sm rounded-btn">Logout</a></li>
                    <?php else: ?>
                        <li><a href="index.php?page=login" class="btn btn-ghost btn-sm rounded-btn">Login</a></li>
                        <li><a href="index.php?page=register" class="btn btn-ghost btn-sm rounded-btn">Register</a></li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </header>
</body>
</html>
