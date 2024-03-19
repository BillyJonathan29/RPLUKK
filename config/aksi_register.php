<?php 

include 'koneksi.php';

$username = $_POST['username'];
$password = md5($_POST['password']);
$email = $_POST['namalengkap'];
$namalengkap = $_POST['namalengkap'];
$alamat = $_POST['alamat'];

$sql = mysqli_query($koneksi, "INSERT INTO user VALUES ('', '$username','$password','$email','$namalengkap','$namalengkap')");


if($sql){
    echo "<script>
    alert('Pendsaftaran Akun Berhasil');
    location.href='../login.php';
    </script>";
}


?>