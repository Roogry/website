<?php

    if(isset($_POST['submit'])){
        include 'model/koneksi.php';
        session_start();

        $username = $_POST['username'];
        $password = $_POST['password'];

        $petugas = $conn->query("SELECT * FROM petugas WHERE username = '". $username . "' AND password = '" . $password . "'");
        $pegawai = $conn->query("SELECT * FROM pegawai WHERE username = '". $username . "' AND password = '" . $password . "'");

        if($petugas){
            while($row = $petugas->fetch()) {     
              $_SESSION["id"] = $row[0];
              $_SESSION["nama"] = $row["nama_petugas"];
              $_SESSION["username"] = $row["username"];
              $_SESSION["level"] = $row["id_level"]; 
            }
            header ("Location: peminjaman.php");
        }

        if($pegawai){
            while($row = $pegawai->fetch()) {     
              $_SESSION["id"] = $row[0];
              $_SESSION["nama"] = $row["nama_pegawai"];
              $_SESSION["username"] = $row["username"];
              $_SESSION["level"] = "3"; 
            }
            header ("Location: peminjaman.php");
        }
    }
    
?>

<!DOCTYPE html>
<html>
<head>

    <title>Page Title</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
    <!-- As a link -->
    <nav class="navbar navbar-light bg-light">
        <a class="navbar-brand" href="#">Login</a>
    </nav>

    <div class="container mt-5">
        <form action="" method="POST">
            <div class="form-group">
                <label>Username</label>
                <input  name="username" class="form-control" placeholder="Username">
            </div>
            <div class="form-group">
                <label>Password</label>
                <input name="password" type="password" class="form-control" placeholder="Password">
            </div>
            <button name="submit" type="submit" class="btn btn-primary">Login</button>
        </form>
    </div>

</body>
</html>