<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>SISKD - SISTEM INFORMASI KEHADIRAN DOSEN</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <div class="container-xxl position-relative bg-white d-flex p-0">

        <!-- Sign In Start -->
        <div class="container-fluid">
            <div class="d-flex align-items-center justify-content-between mt-3">
                <form class="d-none d-md-flex" action="index.php" method="get">
                    <input class="form-control border-0" type="search"name="cari" placeholder="Cari Dosen">
                    <button type="submit" class="btn btn-primary w-20 ">cari</button>
                </form>
                <a class=" btn btn-primary" href="signin.php">Login</a>
                        
            </div>
            <div class="col-sm-12 col-xl-12 mt-1">
                <div class="text-center mt-5 mb-4"> 
                    <h1>SELAMAT DATANG DI SISTEM INFORMASI KEHADIRAN DOSEN</h1>
                    <h2>TEKNIK INFORMATIKA</h2>
                    <h2>UNIVERSITAS NEGERI GORONTALO</h2>
                </div>
                <div class="bg-light rounded h-50 p-5" style="position: relative;">
                     <div class="background-image" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-image: url('img/ung.png'); background-size: 30%; opacity: 0.1;background-repeat: no-repeat;background-position: center top;"></div>
                    <div class="owl-carousel testimonial-carousel">
                    <?php
                    include'koneksi.php';
                    $dosen=mysqli_query($koneksi,"SELECT * FROM user WHERE jenis = 'Dosen' OR jenis='Kaprodi'");
                    while ($dos=mysqli_fetch_array($dosen)) {
                     ?>
                        <div class="testimonial-item text-center">
                            <img class="img-fluid rounded-circle mx-auto mb-4" src="admin/img/<?php echo $dos['foto'] ?>" style="width: 100px; height: 100px;opacity: 1.0">
                            <h5 class="mb-1"><?php echo $dos['nama']; 
                            $lokasi=mysqli_query($koneksi,"SELECT * FROM lokasi_dosen WHERE nip='$dos[nip];'");
                            $status=mysqli_fetch_array($lokasi);
                            $ceki=mysqli_num_rows($lokasi);
                            if ($ceki>0) {
                                if ($status['status'] == 'online') {
                                echo ' <i class="fa fa-circle text-success"></i></h5> <p>Lokasi :' .$status['nama_kampus'].'</p>';
                                }else{
                                    echo ' <i class="fa fa-circle text-danger"></i></h5> <p>'.$status['nama_kampus'].'</p>';
                                }
                            }else{
                                echo ' <i class="fa fa-circle text-danger"></i></h5> <p>Offline</p>';
                            }
                            
                            ?>
                        </div>
                    <?php } ?>
                    </div>
                </div>
            </div>
            <?php
            if (isset($_GET['cari'])) {
                $cari = $_GET['cari'];
                $dosen=mysqli_query($koneksi,"SELECT * FROM user WHERE jenis <> 'admin' AND nama LIKE'%".$cari."%' ");
            }else{
            $dosen=mysqli_query($koneksi,"SELECT * FROM user WHERE jenis = 'Dosen' OR jenis='Kaprodi'");
            }
            while ($dos=mysqli_fetch_array($dosen)) {
            ?>
            <div class="d-flex border-bottom py-3">
                <img class="rounded-circle flex-shrink-0" src="admin/img/<?php echo $dos['foto'] ?>" alt="" style="width: 40px; height: 40px;">
                <div class="w-100 ms-3">
                    <div class="d-flex w-100 justify-content-between">
                        <h6 class="mb-0"><?php echo $dos['nama']; 
                         $lokasi=mysqli_query($koneksi,"SELECT * FROM lokasi_dosen WHERE nip='$dos[nip];'");
                            $status=mysqli_fetch_array($lokasi);
                            $ceki=mysqli_num_rows($lokasi);
                            if ($ceki>0) {
                                if ($status['status'] == 'online') {
                                echo ' <i class="fa fa-circle text-success"></i></h5><small><?php echo  date("d F Y") ?></small>
                    </div>
                    <div class="d-flex w-100 justify-content-between">
                        <span>Lokasi Saat Ini '.$status['nama_kampus'].'</span>
                    </div>';
                                }else{
                                    echo ' <i class="fa fa-circle text-danger"></i></h5><small><?php echo  date("d F Y") ?></small>
                    </div>
                    <div class="d-flex w-100 justify-content-between">
                        <span>'.$status['nama_kampus'].'</span>
                    </div>';
                                }
                            }else{
                                echo ' <i class="fa fa-circle text-danger"></i></h5><small><?php echo  date("d F Y") ?></small>
                    </div>
                    <div class="d-flex w-100 justify-content-between">
                        <span>Offline</span>
                    </div>';
                            }
                            
                            ?>
                    <div class="d-flex w-100 align-text-center">
                        <a href="detail.php?nip=<?php echo $dos['nip'] ?>"><i class="fa fa-info-circle me-1 mt-1"></i>Detail</a>
                    </div>
                </div>
            </div>
        <?php } ?>
        </div>
                    </div>
                </div>
            </div>
            <!-- Recent Sales End -->

            <!-- Footer Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="bg-light rounded-top p-4">
                    <div class="row">
                        <div class="col-12 col-sm-6 text-center text-sm-start">
                            &copy; <a href="#">Universitas Negri Gorontalo</a>, Teknik Informatika. 
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Sign In End -->
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/chart/chart.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
        <script>
        // Refresh halaman setiap 24 jam
        setInterval(function() {
            location.reload();
        }, 60000); 
    </script>

</body>

</html>
