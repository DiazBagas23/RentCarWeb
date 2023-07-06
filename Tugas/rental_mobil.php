<?php
function koneksiDatabase() {
    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "rental_mobil";
    $conn = mysqli_connect($host, $username, $password, $database);
    if (!$conn) {
        die("Koneksi gagal: " . mysqli_connect_error());
    }
    return $conn;
}
session_start();

// Memeriksa jika pengguna belum login, redirect ke halaman login
if (!isset($_SESSION['username'])) {
    header("Location:home.php");
    exit();
}

// Logout pengguna
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location:home.php");
    exit();
}

// Memproses input data mobil
if (isset($_POST['submit_mobil'])) {
    $mobil = $_POST['mobil'];
    $merk = $_POST['merk'];

    // Memanggil fungsi koneksiDatabase()
    $conn = koneksiDatabase();

    // Melakukan query untuk menyimpan data mobil ke database
    $query = "INSERT INTO mobil (nama, merk) VALUES ('$mobil', '$merk')";
    $result = mysqli_query($conn, $query);

    if ($result) {
        echo "Data mobil berhasil disimpan.";
    } else {
        echo "Gagal menyimpan data mobil.";
    }

    // Menutup koneksi ke database
    mysqli_close($conn);
}

// Memproses input data pelanggan
if (isset($_POST['submit_pelanggan'])) {
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];

    // Memanggil fungsi koneksiDatabase()
    $conn = koneksiDatabase();

    // Melakukan query untuk menyimpan data pelanggan ke database
    $query = "INSERT INTO pelanggan (nama, alamat) VALUES ('$nama', '$alamat')";
    $result = mysqli_query($conn, $query);

    if ($result) {
        echo "Data pelanggan berhasil disimpan.";
    } else {
        echo "Gagal menyimpan data pelanggan.";
    }

    // Menutup koneksi ke database
    mysqli_close($conn);
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Rental Mobil</title>
    <link rel="stylesheet"  href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

    <div class="judul">
    <h1>Rental Mobil</h1>
    </div>

<section>

        <div class="box">
            <div class="form">
                <h2>Input Data Mobil</h2>
                 <form class="" method="post" action="">
                    <div class="input8x">
                            <label for="mobil">Nama Mobil:</label>
                            <input type="text" name="mobil" placeholder="Nama Mobil" id="mobil" required>
                    </div>  
        <br> 
        <br>
                    <div class="input8x">
                            <label for="merk">Merk Mobil:</label>
                            <input type="text" name="merk"  placeholder="Merk Mobil" id="merk" required>
                    </div>
        <br>
        <br>
                    <div class="input8x">
                                        <input type="submit" name="submit_mobil" value="Submit">
        </div>
        <br>
        <div class="input8x">
            <input type="button" value="Lihat Data Mobil" onclick="window.location.href='MobilTampil.php'">
        </div>


    </form>
    </div>
    </div>

    <div class="box1">
    <div class="form1">
    <h2>Input Data Pelanggan</h2>
    <form class="" method="post" action="">
        <div class="input8x">
                                        <label for="nama">Nama Pelanggan:</label>
                                        <input type="text" name="nama"placeholder="Nama Pelanggan" id="nama" required>
        </div>
        <br>
        <div class="input8x">
                                         <label for="alamat">Alamat Pelanggan:</label>
                                        <input type="text" name="alamat"placeholder="Alamat" id="alamat" required>
        </div>
        <br>
        <div class="input8x">
                                        <input type="submit" name="submit_pelanggan" value="Submit">
        </div>
        <br>
        <div class="input8x">
            <input type="button" value="Lihat Data Pelanggan" onclick="window.location.href='PelangganTampil.php'">
        </div>
        <div class="input8x">
            <input type="button" value="Input Pemesanan" onclick="window.location.href='inputRental.php'">
        </div>
        <a href="?logout=true">Logout</a>
        </div>
    </form>

    </div>
   
    </div>


</section>
</body>
</html>