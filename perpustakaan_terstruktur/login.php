<html>
    <body>
    <form action="login.php" method="post">
    <label for="username">Username:</label><br>
    <input type="text" id="username" name="username"><br><br>
    <label for="password">Password:</label><br>
    <input type="password" id="password" name="password"><br><br>
    <input type="submit" value="Login">
    </form>


    <?php
    session_start();
    $link = mysqli_connect("127.0.0.1", "root", "", "perpustakaan");

    if ($link->connect_error) {
        die("Koneksi ke database gagal: " . $link->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST["username"];
        $password = $_POST["password"];

        $query = "SELECT * FROM anggota WHERE username = '$username' AND password = '$password'";
        $result = $link->query($query);

        if ($result->num_rows == 1) {
            // Login berhasil
            $user = $result->fetch_assoc();
            $_SESSION["user_id"] = $user["id"];
            $_SESSION["user_nama"] = $user["username"];
            header("Location: fitur.php"); // Ganti dengan halaman dashboard atau halaman setelah login
        } else {
            // Login gagal
            echo "Username atau password salah.";
        }
    }

$link->close();
?>
</body>
</html>
