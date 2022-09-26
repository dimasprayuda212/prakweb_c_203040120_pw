<?php

function koneksi()
{
    return mysqli_connect('localhost', 'root', '', 'prakweb_c_203040120_pw');
}

function query($query)
{
    $conn = koneksi();

    $result = mysqli_query($conn, $query);

    // jika hasilnya hanya 1 data
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

    $judul = htmlspecialchars($data['judul']);
    $pengarang  = htmlspecialchars($data['pengarang']);
    $penerbit = htmlspecialchars($data['penerbit']);
    $terbit = htmlspecialchars($data['terbit']);

    // upload img
    $img = upload();
    if(!$img) {
        return false;
    }

    $query = "INSERT INTO
                buku
                VALUES
                ('','$img', '$judul', '$pengarang', '$penerbit', '$terbit');
                ";
    mysqli_query($conn, $query) or die(mysqli_error($conn));
    return mysqli_affected_rows($conn);
}

function upload() {

    $nama_file = $_FILES['gambar']['name'];
    $tipe_file = $_FILES['gambar']['type'];
    $ukuran_file = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmp_file = $_FILES['gambar']['tmp_name'];

    // ketika tidak ada gambar tidak dipilih
    if($error == 4) {
        // echo "<script>
        //         alert('pilih gambar terlebih dahulu!');
        //     </script>";
        return 'nophoto.png';
    }

    // cek ekstensi file
    $daftar_gambar = ['jpg', 'jpeg', 'png'];
    $ekstensi_file = explode('.', $nama_file);
    $ekstensi_file = strtolower(end($ekstensi_file));
    if(!in_array($ekstensi_file, $daftar_gambar)) {
        echo "<script>
                alert('yang anda pilih bukan gambar!');
            </script>";
        return false;
    }

    // cek type file
    if($tipe_file != 'image/jpeg' && $tipe_file != 'image/png') {
        echo "<script>
                alert('yang anda pilih bukan gambar!');
            </script>";
        return false;
    }

    // cek ukuran file
    // maksimal 5Mb == 5000000
    if ($ukuran_file > 5000000) {
        echo "<script>
                alert('ukuran terlalu besar!');
            </script>";
        return false;
    }

    // lolos pengecekan
    // siap upload file
    // generate nama file baru
    $nama_file_baru = uniqid();
    $nama_file_baru .= '.';
    $nama_file_baru .= $ekstensi_file;
    move_uploaded_file($tmp_file, 'img/' . $nama_file_baru);

    return $nama_file_baru;
}

function hapus($id)
{
    $conn = koneksi();

    // menghapus gambar di folder img
    $book = query("SELECT * FROM buku WHERE id = $id");
    if($book['img'] != 'nophoto.png') {
        unlink('img/' . $book['img']);
    }
    

    mysqli_query($conn, "DELETE FROM buku WHERE id = $id") or die(mysqli_error($conn));   
}

function ubah($data)
{

    $conn = koneksi();

    $id = $data['id'];
    $judul = htmlspecialchars($data['judul']);
    $pengarang  = htmlspecialchars($data['pengarang']);
    $penerbit = htmlspecialchars($data['penerbit']);
    $terbit = htmlspecialchars($data['terbit']);
    $img_lama = htmlspecialchars($data['img_lama']);

    $img = upload();
    if (!$img) {
        return false;
    }

    if ($img == 'nophoto.jpg') {
        $img = $img_lama;
    }

    $query = "UPDATE mahasiswa SET
                judul = '$judul',
                pengarang = '$pengarang',
                penerbit = '$penerbit',
                terbit = '$terbit',
                img = '$img'
                WHERE id = $id";
    mysqli_query($conn, $query) or die(mysqli_error($conn));
    return mysqli_affected_rows($conn);
}
?>