<?php
session_start();
include '../config/koneksi.php';

$userid = $_SESSION['userid'];

if ($_SESSION['status'] != "login") {
    echo "<script>
    alert('data Foto Berhasil Di Update');
    location.href='../admin/foto.php';
    </script>";
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"> -->
    <link rel="stylesheet" href="../assets/icons/icon.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container">
            <a class="navbar-brand" href="index.php">Galeri Foto</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse mt-2" id="navbarNavAltMarkup">
                <div class="navbar-nav me-auto">
                    <a href="home.php" class="nav-link">Home</a>
                    <a href="album.php" class="nav-link">Album</a>
                    <a href="foto.php" class="nav-link">Foto</a>
                </div>
                <a href="../config/logout.php" class="btn btn-outline-danger m-1">Logout</a>
            </div>
        </div>
    </nav>

    <div class="container mt-3">
        Album :
        <?php
        $userid = $_SESSION['userid'];
        $album = mysqli_query($koneksi, "SELECT * FROM album WHERE userid='$userid'");
        while ($row = mysqli_fetch_array($album)) { ?>
            <a href="home.php?albumid=<?php echo $row['albumid'] ?>" class="btn btn-outline-success"><?php echo $row['namaalbum'] ?></a>
        <?php }
        ?>


        <div class="row">
            <?php
            if (isset($_GET['albumid'])) {
                $albumid = $_GET['albumid'];
                $query = mysqli_query($koneksi, "SELECT * FROM foto WHERE userid='$userid' AND albumid='$albumid'");
                while ($data = mysqli_fetch_array($query)) { ?>
                    <div class="col-md-3 mt-2">
                        <div class="card mt-3">
                            <img src="../assets/img/<?php echo $data['lokasifile'] ?>" class="card-img-top" style="height:12rem;" title="<?php echo $data['judulfoto'] ?>">
                            <div class="card-footer text-center bg-light">
                                <?php
                                $fotoid = $data['fotoid'];
                                $cekSuka = mysqli_query($koneksi, "SELECT * FROM likefoto WHERE fotoid='$fotoid' AND userid='$userid'");
                                if (mysqli_num_rows($cekSuka) == 1) { ?>
                                    <a href="../config/proses_like.php?fotoid=<?php echo $data['fotoid'] ?>" type="submit" name="batalsuka"><i class="fa fa-heart"></i></a>
                                <?php } else { ?>
                                    <a href="../config/proses_like.php?fotoid=<?php echo $data['fotoid'] ?>" type="submit" name="suka"><i class="fa-regular fa-heart"></i></a>
                                <?php }

                                $like = mysqli_query($koneksi, "SELECT * FROM likefoto WHERE fotoid='$fotoid'");
                                echo mysqli_num_rows($like) . 'suka';

                                ?>
                                <a href="" class="fa-regular fa-comment text-decoration-none"></a>
                            </div>
                        </div>
                    </div>


                <?php }
            } else {
                $query = mysqli_query($koneksi, "SELECT * FROM foto WHERE userid='$userid'");
                while ($data = mysqli_fetch_array($query)) { ?>
                    <div class="col-md-3 mt-2">
                        <div class="card mt-3">
                            <img src="../assets/img/<?php echo $data['lokasifile'] ?>" class="card-img-top" style="height:12rem;" title="<?php echo $data['judulfoto'] ?>">
                            <div class="card-footer text-center bg-light">
                                <?php
                                $fotoid = $data['fotoid'];
                                $cekSuka = mysqli_query($koneksi, "SELECT * FROM likefoto WHERE fotoid='$fotoid' AND userid='$userid'");
                                if (mysqli_num_rows($cekSuka) == 1) { ?>
                                    <a href="../config/proses_like.php?fotoid=<?php echo $data['fotoid'] ?>" type="submit" name="batalsuka"><i class="fa fa-heart"></i></a>
                                <?php } else { ?>
                                    <a href="../config/proses_like.php?fotoid=<?php echo $data['fotoid'] ?>" type="submit" name="suka"><i class="fa-regular fa-heart"></i></a>
                                <?php }

                                $like = mysqli_query($koneksi, "SELECT * FROM likefoto WHERE fotoid='$fotoid'");
                                echo mysqli_num_rows($like) . 'suka';

                                ?>
                                <a href="" class="fa-regular fa-comment text-decoration-none"></a>
                            </div>
                        </div>
                    </div>


                <?php }
            }

            ?>
        </div>
    </div>


    <footer class="justify-content-center d-flex bg-light border-top mt-3 fixed-bottom mx-auto">
        <p class="mt-3">
            Copyright &copy; 2022
        </p>
    </footer>

    <script src="../assets/js/bootstrap.min.js"></script>
</body>

</html>