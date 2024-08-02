<main class="container mx-auto p-4 flex-grow flex flex-col justify-center items-center">
    <h2 class="text-2xl font-bold mb-4">Login</h2>
    <form method="post" action="index.php?page=login" class="w-full max-w-md flex flex-col items-center">
        <input type="text" name="username" placeholder="Username" required class="input input-bordered w-full max-w-xs mb-4">
        <input type="password" name="password" placeholder="Password" required class="input input-bordered w-full max-w-xs mb-4">
        <button type="submit" class="btn btn-primary">Login</button>
    </form>
</main>
