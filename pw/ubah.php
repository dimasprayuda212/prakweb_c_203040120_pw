<?php
require 'function.php';

// jika tidak ada id di url
if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

// ambil id dari url
$id = $_GET['id'];

// query mahasiswa berdasarkan id
$book = query("SELECT * FROM buku WHERE id = $id");

// cek apakah tombol ubah sudah ditekan
if (isset($_POST['ubah'])) {
    if (ubah($_POST) > 0) {
        echo "<script>
                alert('data berhasil diubah');
                document.location.href = 'index.php';
            </script>";
    } else {
        echo "data gagal diubah!";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Data Buku</title>
</head>

<body>
    <h3>Form Ubah Data Buku</h3>
    <form action="" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $book['id']; ?>">
        <ul>
        <li>
        <label>
          Gambar :
          <input type="text" name="img" autofocus required value="<?= $b['img']; ?>">
        </label>
      </li>
      <li>
        <label>
          Judul :
          <input type="text" name="judul" required value="<?= $b['judul']; ?>">
        </label>
      </li>
      <li>
        <label>
          Pengarang :
          <input type="text" name="pengarang" required value="<?= $b['pengarang']; ?>">
        </label>
      </li>
      <li>
        <label>
          Penerbit :
          <input type="text" name="penerbit" required value="<?= $b['penerbit']; ?>">
        </label>
      </li>
      <li>
        <label>
          Terbit :
          <input type="text" name="terbit" required value="<?= $b['terbit']; ?>">
        </label>
      </li>
      <li>
        <button type="submit" name="ubah">Ubah Data</button>
      </li>
        </ul>
    </form>

    <script src="script.js"></script>
</body>

</html>