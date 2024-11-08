<?php
include "conn.php";
include "func.php";
session_start();
if (isset($_SESSION['idUser'])) {
    $idUser = $_SESSION['idUser'];
}
$sql = "SELECT posts.*, users.username, 
    (SELECT COUNT(*) FROM likes WHERE likes.id_post = posts.id_post) as like_count,
    (SELECT COUNT(*) FROM comments WHERE comments.id_post = posts.id_post) as comment_count
    FROM posts
    JOIN users ON posts.id_user = users.id_user";
$posts = ambilData($conn, $sql);
shuffle($posts);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EchoArtworks</title>
    <link rel="stylesheet" href="styles/index.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>
    body {
        display: flex;
        flex-direction: column;
        min-height: 100vh;
    }

    main {
        flex: 1;
        padding: 20px;
    }
    </style>
</head>


<body>
    <header>
        <!-- Navbar -->
        <?php include 'navbar.php'; ?>

    </header>
    <main>
        <!-- Login/Tidak -->

        <?php if (!isset($_SESSION['login'])) : ?>
        <div class="container-login">
            <div class="container-login-isi">
                <p style="text-align: center;">Belum login atau daftar?</p>
                <p> Ayo gunakan akun kamu untuk akses semua fitur!</p>
            </div>
            <div class="pilih">
                <a href="logres.php" class="login-button">Login atau Daftar</a>
            </div>
        </div>
        <?php endif; ?>
        <!-- Postingan -->
        <?php if (!$posts) : ?>
        <h1>Belum ada postingan</h1>
        <?php else : ?>
        <div class="postingan">
            <?php foreach ($posts as $post) : ?>
            <div>
                <a href="detail.php?id_post=<?= $post['id_post'] ?>"><img src="<?= $post['image'] ?>" alt=""></a>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </main>

    <footer>
        <?php include 'footer.php'; ?>
    </footer>
    <script src="script/script.js"></script>
    <script src="script/search.js"></script>
</body>

</html>