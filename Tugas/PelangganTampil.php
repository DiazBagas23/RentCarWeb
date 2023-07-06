<!DOCTYPE html>
<html>
<head>
    <title>Data Pelanggan</title>
    <style>
        section{
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: linear-gradient(-25deg, #03a9f4 0%, #3a78b7 50%, #262626 50%, #607d8d 100%);
            backdrop-filter: hue-rotate(120deg);
            animation: animate 10s ease-in infinite;

        } 
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-image: url(bg.jpg);
        }

        table {
            border-radius: 1px;
            width: 100%;
            border-collapse: collapse;
        }

        table th,
        table td {
            padding: 8px;
            border-collapse: collapse;
        }

        table th {
           
            font-weight: bold;
        }

        table tr:nth-child(even) {
            border-collapse: collapse;
        }
        .back-button input {
            
            outline: none;
            border: 1px solid rgba(255, 255, 255, 0.2);
            background: transparent;
            padding: 8px 10px;
            padding-left: 5px;
            border-radius: 6px;
            color: white;
            font-size: 20px;
            font-weight: 300;
            box-shadow: inset 0 0 25px rgba(0, 0, 0, 0.2);

        }
    </style>
</head>
<body>
    <section>
        
    
    <div class="container">
        <h1>Data Pelanggan</h1>

        <?php
        // Koneksi ke database
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "rental_mobil";

        $conn = new mysqli($servername, $username, $password, $database);
        if ($conn->connect_error) {
            die("Koneksi gagal: " . $conn->connect_error);
        }
                // Fungsi untuk menghapus data pelanggan dan rental terkait
                function hapusPelanggan($id) {
                    global $conn;
        
                    // Hapus data rental terkait dengan pelanggan
                    $queryRental = "DELETE FROM rental WHERE pelanggan_id = '$id'";
                    $conn->query($queryRental);
        
                    // Hapus data pelanggan
                    $queryPelanggan = "DELETE FROM pelanggan WHERE id = '$id'";
                    if ($conn->query($queryPelanggan) === TRUE) {
                        echo "Data pelanggan berhasil dihapus.";
                    } else {
                        echo "Error: " . $queryPelanggan . "<br>" . $conn->error;
                    }
                }
        
                // Memproses aksi hapus jika ada parameter id yang diterima
                if (isset($_GET["hapus"])) {
                    $pelanggan_id = $_GET["hapus"];
                    hapusPelanggan($pelanggan_id);
                }
        
                // Query untuk mendapatkan data pelanggan
                $query = "SELECT * FROM pelanggan";
                $result = $conn->query($query);
        
                if ($result->num_rows > 0) {
                    echo "<table>";
                    echo "<tr><th>ID</th><th>Nama</th><th>Alamat</th><th>Aksi</th></tr>";
        
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["id"] . "</td>";
                        echo "<td>" . $row["nama"] . "</td>";
                        echo "<td>" . $row["alamat"] . "</td>";
                        echo "<td><a href='" . $_SERVER["PHP_SELF"] . "?hapus=" . $row["id"] . "' class='delete-button'>Hapus</a></td>";
                        echo "</tr>";
                    }
        
                    echo "</table>";
                } else {
                    echo "Tidak ada data pelanggan.";
                }
        
                // Menutup koneksi ke database
                $conn->close();
                ?>
        
                <div class="back-button">
                    <input type="button" value="Kembali" onclick="window.location.href='rental_mobil.php'">
                </div>
            </div>
        </body>
        </html>