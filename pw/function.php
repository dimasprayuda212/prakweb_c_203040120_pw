<?php
function koneksi()
{
  return mysqli_connect('localhost', 'root', '', 'prakweb_c_203040120_pw');
}

function query($query)
{
  // Query isi tabel mahasiswa
  $conn = koneksi();

  $result = mysqli_query($conn, $query);

  if (mysqli_num_rows($result) == 1) {
    return mysqli_fetch_assoc($result);
  }

  $rows = [];
  while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
  }

  return $rows;
}

function tambah($data)
{
  $conn = koneksi();

  $img = htmlspecialchars($data['img']);
  $judul = htmlspecialchars($data['judul']);
  $pengarang = htmlspecialchars($data['pengarang']);
  $penerbit = htmlspecialchars($data['penerbit']);
  $terbit = htmlspecialchars($data['terbit']);

  $query = "INSERT INTO
                  buku
                  values
                  (null, '$img', '$judul', '$pengarang', '$penerbit', '$terbit')";
  mysqli_query($conn, $query) or die(mysqli_error($conn));
  // echo mysqli_error($conn);
  return mysqli_affected_rows($conn);
}

function hapus($id)
{
  $conn = koneksi();
  mysqli_query($conn, "DELETE FROM buku WHERE id = $id") or die(mysqli_error($conn));
  return mysqli_affected_rows($conn);
}

function ubah($data)
{
  $conn = koneksi();

  $id = $data['id'];
  $img = htmlspecialchars($data['img']);
  $judul = htmlspecialchars($data['judul']);
  $pengarang = htmlspecialchars($data['pengarang']);
  $penerbit = htmlspecialchars($data['penerbit']);
  $terbit = htmlspecialchars($data['terbit']);

  $query = "UPDATE buku SET
            img = '$img',
            judul = '$judul',
            pengarang = '$pengarang',
            penerbit = '$penerbit',
            terbit = '$terbit'
            WHERE id = $id";
  mysqli_query($conn, $query) or die(mysqli_error($conn));
  // echo mysqli_error($conn);
  return mysqli_affected_rows($conn);
}