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
<html lang="en">
<head>
    <title>Login</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <form action="" method="post">
            <div class="form-group">
                <label>Username</label>
                <input type="text" class="form-control" placeholder="username" name="username">
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control" placeholder="password" name="password">
            </div>
            <button name="submit" type="submit" class="btn btn-primary">Login</button>
        </form>
    </div>
</body>
</html>