<?php
session_start();

// Fungsi untuk melakukan koneksi ke database
function connectToDatabase() {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "rental_mobil";

    $conn = new mysqli($servername, $username, $password, $database);
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    return $conn;
}

// Memeriksa jika pengguna telah melakukan login sebelumnya, redirect ke halaman terkait
if (isset($_SESSION['username'])) {
    header("Location:rental_mobil.php");
    exit();
}

// Memeriksa jika ada data yang dikirimkan melalui form login
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Melakukan koneksi ke database
    $conn = connectToDatabase();

    // Mengecek kecocokan username dan password dalam database
    $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        // Username dan password cocok, set session untuk menyimpan status login
        $_SESSION['username'] = $username;

        // Redirect ke halaman terkait setelah login sukses
        header("Location:rental_mobil.php");
        exit();
    } else {
        $error_message = "Username atau password yang Anda masukkan salah.";
    }

    $conn->close();
}
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <link rel="stylesheet" href="home.css">
    <title>Form Login</title>
</head>
<body>
    <section>
        <div class="box">

            <div class="form">
                <img src="images/_user.jpg" class="user" alt="">
                <h2>Selamat Datang </h2>
                <?php if (isset($error_message)) { ?>
            <p class="error-message"><?php echo $error_message; ?></p>
                    <?php } ?>
                <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
                    <!-- {% csrf_token %} -->
                    <div class="inputBx">
                        <input type="text" name="username" placeholder="Username" id="username" required autofocus>
                        <img src="images/user.png" alt="">
                    </div>
                    <div class="inputBx">
                        <input type="password" name="password" id="password" placeholder="Passward" required>
                        <img src="images/lock.png" alt="">
                    </div>
                    <div class="inputBx">
                        <input type="submit" name="submit" value="Login" id="submit">
                    </div>
                </form>
                <p>Contact Me On ==>><a href="https://github.com/DiazBagas23">Github</a>? </p>
            </div>

        </div>
    </section>
</body>
</html>
