<?php

session_start();
include 'koneksi.php';

if (isset($_POST['tambah'])) {
    $userid = $_SESSION['userid'];
    $namaalbum = $_POST['namaalbum'];
    $deskripsi = $_POST['deskripsi'];
    $tanggaldibuat = date('Y-m-d');

    $sql = mysqli_query($koneksi, "INSERT INTO album VALUES ('', '$namaalbum', '$deskripsi', '$tanggaldibuat', '$userid')");

    if ($sql) {
        echo "<script>
        alert('Data Album Berhasil Di Tambahkan');
        location.href='../admin/album.php';
        </script>";
    }
}

if (isset($_POST['edit'])) {
    $userid = $_SESSION['userid'];
    $namaalbum = $_POST['namaalbum'];
    $deskripsi = $_POST['deskripsi'];
    $tanggaldibuat = date('Y-m-d');

    $sql = mysqli_query($koneksi, "UPDATE album SET namaalbum='$namaalbum', deskripsi='$deskripsi', tanggaldibuat='$tanggaldibuat'
    WHERE userid='$userid'");

    if ($sql) {
        echo "<script>
        alert('Data Album Berhasil DI erererererrerer');
        location.href='../admin/album.php';
        </script>";
    }
}


if(isset($_POST['hapus'])){
    $albumid = $_POST['albumid'];

    $sql = mysqli_query($koneksi,"DELETE FROM album WHERE albumid='$albumid'");

    if ($sql) {
        echo "<script>
        alert('Berhasil Di Hapus');
        location.href='../admin/album.php';
        </script>";
    }
}

