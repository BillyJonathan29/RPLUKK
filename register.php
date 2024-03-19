<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
</head>
<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container">
    <a class="navbar-brand" href="#">Galeri Foto</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav me-auto">
        <!-- <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Album</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Foto</a>
        </li> -->
      </ul>
      <a href="login.php" class="btn btn-outline-success m-2">Login</a>
      <a href="register.php" class="btn btn-outline-primary">Register</a>
    </div>
  </div>
</nav>


<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header text-center">
                    <h4>Register Akun</h4>
                </div>
                <div class="card-body bg-light">
                    <form action="config/aksi_register.php" method="post">
                        <label for="" class="form-label">Username</label>
                        <input type="text" name="username" class="form-control">
                        <label for="" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control">
                        <label for="" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control">
                        <label for="" class="form-label">Nama Lengkap</label>
                        <input type="text" name="namalengkap" class="form-control">
                        <label for="" class="form-label">Alamat</label>
                        <textarea name="alamat" class="form-control"></textarea>
                        <div class="d-grid mt-3">
                            <button type="submit" name="kirim" class="btn btn-primary">Register</button>
                        </div>
                    </form>
                    <hr>
                    <p>Sudah Punya Akun ? <a href="login.php" class="text-decoration-none">Login</a></p>
                </div>
            </div>
        </div>
    </div>
</div>


<br><br><br><br><br><br><br><br>


<footer class="d-flex justify-content-center mt-3 border-top bg-light fixed-bottom">
    <p class="p-2">&copy; Latihan UKK By billy</p>
</footer>
<script src="assets/js/bootstrap.min.js"></script>
</body>
</html>