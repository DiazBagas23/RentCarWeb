<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "rental_mobil";

    $conn = new mysqli($servername, $username, $password, $database);
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
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
    $query1 = "SELECT * FROM mobil";
    $result1 = $conn->query($query1);

    $query2 = "SELECT * FROM pelanggan";
    $result2 = $conn->query($query2);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $mobil_id = $_POST["mobil_id"];
        $pelanggan_id = $_POST["pelanggan_id"];
        $tanggal_rental = $_POST["tanggal_rental"];

        $query = "INSERT INTO rental (mobil_id, pelanggan_id, tanggal_rental) VALUES ('$mobil_id', '$pelanggan_id', '$tanggal_rental')";
        if ($conn->query($query) === TRUE) {
            echo "Data rental berhasil disimpan.";
        } else {
            echo "Error: " . $query . "<br>" . $conn->error;
        }
        $conn->close();
    }
    ?>
<!DOCTYPE html>
<html>
<head>
    <title>Form Input Rental</title>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style1.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<div class="judul">
    <h1>Rental Mobil</h1>
    </div> 
    <section>
         <div class="box">
            <div class="form">
            <h2>Form Input Rental</h2>
                <div class="input8x">
    <form class=""  method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <label for="mobil_id">Mobil:</label>
        <br>
        <select name="mobil_id" id="mobil_id" style="color : pink ;">
            <option value="">Pilih Mobil</option>
            <?php
            if ($result1->num_rows > 0) {
                while ($row = $result1->fetch_assoc()) {
                    echo "<option value='" . $row["id"] . "'>" . $row["nama"] . "</option>";
                }
            }
            ?>
        </select>
        </div>
        <br><br>
            <div class="input8x">
                
          
        <label for="pelanggan_id">Pelanggan:</label>
        <br>
        <select name="pelanggan_id" id="pelanggan_id" style="color : green ;">
            <option value="">Pilih Pelanggan</option>
            <?php
            if ($result2->num_rows > 0) {
                while ($row = $result2->fetch_assoc()) {
                    echo "<option value='" . $row["id"] . "'>" . $row["nama"] . "</option>";
                }
            }
            ?>
        </select>
        </div>
        <br><br>
        <div class="input8x">
        <label for="tanggal_rental">Tanggal Rental:</label>
        <input type="date" name="tanggal_rental" id="tanggal_rental" required>
        </div>
        <br><br>
        <div class="input8x">
        <input type="submit" value="Submit">
        </div>
        <br>
        <div class="input8x">
            <input type="button" value="Lihat Pesanan" onclick="window.location.href='RentalTampil.php'">
        </div>
        <br>
        <div class="input8x">
            <input type="button" value="Input Data Pelanggan" onclick="window.location.href='rental_mobil.php'">
        </div>
    </form>
    <a href="?logout=true">Logout</a>
    </div>

    </div>

    </section>
</body>
</html>
