<?php
session_start();
include 'conn.php';
include 'func.php';

if (isset($_SESSION['idUser'])) {
    $idUser = $_SESSION['idUser'];
}


if (isset($_GET['id_post'])) {
    $idPost = $_GET['id_post'];
    $sql = "SELECT posts.*, users.username, 
        (SELECT COUNT(*) FROM likes WHERE likes.id_post = posts.id_post) as like_count,
        (SELECT COUNT(*) FROM comments WHERE comments.id_post = posts.id_post) as comment_count,
        (SELECT COUNT(*) FROM likes WHERE likes.id_post = posts.id_post AND likes.id_user = " . (isset($idUser) ? $idUser : 0) . ") as is_liked
        FROM posts
        JOIN users ON posts.id_user = users.id_user 
        WHERE posts.id_post = $idPost";

    $posts = ambilData($conn, $sql);
    $post = $posts[0];
    $sql_comments = "SELECT comments.*, users.id_user, users.username FROM comments JOIN users ON comments.id_user = users.id_user WHERE comments.id_post = $idPost ORDER BY comments.created_at DESC";
    $comments = ambilData($conn, $sql_comments);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EchoArtworks</title>
    <link rel="stylesheet" href="styles/detail.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <!-- Navbar -->
    <?php include 'navbar.php'; ?>
    <header class="btn">
        <a href="index1.php">Kembali</a>
    </header>
    <?php if (!isset($post)) : ?>
    <h1>Post tidak ditemukan</h1>
    <?php else : ?>
    <main>
        <div class="main-container">
            <div class="container-detail">
                <div class="container-post">
                    <!-- post konten  -->
                    <img src="<?= $post['image'] ?>" alt="">
                    <h1><?= $post['caption'] ?></h1>
                    <p><?= $post['description'] ?></p>
                    <form method='POST' action='toggleLike.php'>
                        <input type='hidden' name='id_post' value='<?php echo $post["id_post"]; ?>'>
                        <button type='submit' class="like-button">
                            <i style="font-size: 50px;"
                                class='<?php echo $post['is_liked'] ? "bx bxs-heart liked-icon" : "bx bx-heart like-icon"; ?>'></i>
                            <span class="like-count"><?php echo $post['like_count']; ?></span>
                        </button>
                    </form>

                </div>
                <div class="keterangan">
                    <h1> <strong><a
                                href="profil.php?idUser=<?= $post['id_user'] ?>">@<?= $post['username'] ?></a></strong>
                    </h1>
                    <?php
                        $postingTime = strtotime($post['created_at']);
                        $currentTime = time();
                        $timeDifference = $currentTime - $postingTime;
                        ?>
                    <p> <strong><?= formatTimeElapsed($timeDifference) ?></strong></p>
                    <!-- like -->

                    <!-- donlot -->
                    <a id="downloadBtn" href="<?= $post['image'] ?>" download class="download-btn">Unduh Gambar</a>
                    <!-- dlete dan edit -->
                    <div class="edit-hapus">
                        <?php if (isset($idUser) && $idUser == $post['id_user']): ?>
                        <a href="editPost.php?id_post=<?= $post['id_post'] ?>" class="edit-btn">Edit</a>
                        <a href="deletePost.php?id_post=<?= $post['id_post'] ?>" class="delete-btn"
                            onclick="return confirm('Apakah Anda yakin ingin menghapus postingan ini?');">Hapus</a>
                        <?php endif; ?>
                        <p style="font-size:32px"><i class='bx bx-comment'></i> <?= $post['comment_count'] ?></p>
                    </div>
                </div>

                <!-- komenn -->
                <div class="container-komentar">
                    <h2>Komentar</h2>
                    <form method='POST' action='addComment.php'>
                        <input type='hidden' name='id_post' value='<?php echo $post['id_post']; ?>'>
                        <textarea name='comment_text' placeholder='Tambahkan komentar...' required></textarea>
                        <button name="submit" type='submit' class="tambah">Komentar</button>
                        <br>
                    </form>
                    <?php

                        if (!empty($comments)): ?>
                    <div class="kolom-komentar">
                        <?php foreach ($comments as $comment): ?>
                        <div class="userComment">
                            <p>
                                <a
                                    href="profil.php?idUser=<?= $comment['id_user'] ?>"><strong><?= $comment['username'] ?>:</strong></a>
                                <?= $comment['comment_text'] ?>
                            </p>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>
                </div>
            </div>

        </div>


    </main>
    <?php endif; ?>
    <footer>
        <?php include 'footer.php'; ?>
    </footer>

</body>

</html>