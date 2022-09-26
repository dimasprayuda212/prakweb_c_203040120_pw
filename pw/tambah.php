<?php

require 'function.php';

// cek apakah tombol tambah sudah ditekan
if (isset($_POST['tambah'])) {
    if (tambah($_POST) > 0) {
        echo "<script>
                alert('data berhasil ditambahkan!');
                document.location.href = 'index.php';
            </script>";
    } else {
        echo "data gagal ditambahkan!";
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Buku</title>
</head>

<body>
    <h3>Form Tambah Data Buku</h3>
    <form action="" method="POST" enctype="multipart/form-data">
        <ul>
            <li>
                <label>
                    Judul :
                    <input type="text" name="judul" autofocus required>
                </label>
            </li>
            <li>
                <label>
                    Pengarang :
                    <input type="text" name="pengarang" required>
                </label>
            </li>
            <li>
                <label>
                    Penerbit :
                    <input type="text" name="penerbit" required>
                </label>
            </li>
            <li>
                <label>
                    Terbit :
                    <input type="text" name="terbit" required>
                </label>
            </li>
            <li>
                <label>
                    Gambar :
                    <input type="file" name="gambar" class="gambar" onchange="previewImage()">
                </label>
                <img src="img/noPhoto.png" width="120" style="display: block;" class="img-preview">
            </li>
            <li>
                <button type="submit" name="tambah">Tambah Data!</button>
            </li>
        </ul>
    </form>

    <script src="script.js"></script>
</body>

</html>