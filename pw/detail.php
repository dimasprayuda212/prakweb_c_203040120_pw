<?php
require 'function.php';

// ambil id dari URL
$id = $_GET['id'];

// query buku berdasarkan id
$book = query("SELECT * FROM buku WHERE id = $id");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail buku</title>
</head>

<body>
    <h3>Detail buku</h3>
    <ul>
        <li><img src="img/<?= $book['img']; ?>" width="250"></li>
        <li>NRP : <?= $book['judul']; ?></li>
        <li>Nama : <?= $book['pengarang']; ?></li>
        <li>Email : <?= $book['penerbit']; ?></li>
        <li>Jurusan : <?= $book['terbit']; ?></li>
        <li><a href="ubah.php?id=<?= $book['id']; ?>">ubah</a> | <a href="hapus.php?id=<?= $book['id']; ?>" onclick="return confirm('apakah anda yakin?');">hapus</a></li>
        <li><a href="index.php">Kembali ke daftar buku</a></li>
    </ul>

</body>

</html>