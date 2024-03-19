<?php
session_start();
include '../config/koneksi.php';

$userid = $_SESSION['userid'];

if ($_SESSION['status'] != "login") {
  echo "<script>
    alert('Anda Belum Login ');
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
    <div class="row">
      <?php
      $query = mysqli_query($koneksi, "SELECT * FROM foto INNER JOIN user ON foto.userid=user.userid INNER JOIN album ON foto.albumid=album.albumid");
      while ($data = mysqli_fetch_array($query)) { ?>
        <div class="col-md-3">
          <!-- Button trigger modal -->
          <a type="button" class="" data-bs-toggle="modal" data-bs-target="#komentar<?php echo $data['fotoid'] ?>">
            <div class="card mt-3">
                <img src="../assets/img/<?php echo $data['lokasifile'] ?>" class="card-img-top" title="<?php echo $data['judulfoto'] ?>" style="height:12rem;">
              <div class="card-footer text-center bg-light">
                <?php
                $userid = $_SESSION['userid'];
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
                <a type="button" class="" data-bs-toggle="modal" data-bs-target="#komentar<?php echo $data['fotoid'] ?>"><i class="fa-regular fa-comment"></i></a>
                <?php
                $jmlkomen = mysqli_query($koneksi, "SELECT * FROM komentarfoto WHERE fotoid='$fotoid'");
                echo mysqli_num_rows($jmlkomen) . 'komentar';
                ?>
              </div>
            </div>
          </a>

          <!-- Modal -->
          <div class="modal fade" id="komentar<?php echo $data['fotoid'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="exampleModalLabel">Komentar</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <div class="row">
                    <div class="col-md-8">
                      <img src="../assets/img/<?php echo $data['lokasifile'] ?>" class="card-img-top" title="<?php echo $data['judulfoto'] ?>" style="12rem">
                    </div>
                    <div class="col-md-4">
                      <div class="overflow-auto">
                        <div class="sticky-top">
                          <strong><?php echo $data['judulfoto'] ?></strong><br>
                          <span class="badge bg-secondary"><?php echo $data['namalengkap'] ?></span>
                          <span class="badge bg-secondary"><?php echo $data['tanggalunggah'] ?></span>
                          <span class="badge bg-primary"><?php echo $data['namaalbum'] ?></span>
                        </div>
                        <hr>
                        <p class="left">
                          <?php echo $data['deskripsifoto'] ?>
                        </p>
                        <hr>
                        <?php 
                        $fotoid = $data['fotoid'];
                        $komentar = mysqli_query($koneksi, "SELECT * FROM komentarfoto INNER JOIN user ON komentarfoto.userid=user.userid WHERE komentarfoto.fotoid='$fotoid'");
                        while($row = mysqli_fetch_array($komentar)) { ?> 
                          <p align="left">
                            <strong><?php echo $data['namalengkap'] ?></strong>
                            <?php echo $row['isikomentar'] ?> 
                          </p>
                        <?php }
                        ?>
                        <div class="sticky-bottom">
                          <form action="../config/proses_komentar.php" method="post">
                            <div class="input-group">
                              <input type="hidden" class="form-control" name="fotoid" value="<?php echo $data['fotoid'] ?>">
                              <input type="text" class="form-control" name="isikomentar" placeholder="Isi Komentar">
                              <div class="input-group-prepend">
                                <button type="submit" name="isikomentar" class="btn btn-outline-primary m-2" >Kirim</button>
                              </div>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary">Save changes</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      <?php }
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