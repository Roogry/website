<?php
    include 'model/koneksi.php';
    session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Pengembalian</title>
    <link rel="stylesheet" href="css//bootstrap.min.css">
</head>
<body>
   
    <?php include 'header.php' ?>

    <div class="container">
        <div class="mt-5 mx-auto col-md-4">
            <form action="" method="POST">
                <div class="form-group">
                    <label>Kode Peminjaman</label>
                    <input  name="kode" class="form-control" placeholder="Enter kode" required>
                </div>
                <button name="submit" type="submit" class="btn btn-primary">Kembalikan</button>
            </form>
        </div>
    </div>
    <br><br><br>
</body>
</html>
<?php
    if(isset($_POST ['submit'])){

        $kode = $_POST['kode'];

        if(!empty($kode)){
            $cekKode = $conn->query("SELECT COUNT(*) FROM peminjaman WHERE kode_peminjaman = '$kode'");
            $row = $cekKode->fetch();

            if($cekKode && $row[0] == '1'){
                $cekKode = $conn->query("SELECT COUNT(*) FROM peminjaman WHERE kode_peminjaman = '$kode' AND DATE(`tanggal_kembali`) < DATE(NOW())");
                $kembali = $conn->query("UPDATE peminjaman SET status_peminjaman = '2', tanggal_kembali = NOW() WHERE kode_peminjaman = '$kode'");
                $row = $cekKode->fetch();
                
                if($row[0] != "0"){
                    echo '<h5 class="text-center text-danger">Berhasil, Tetapi anda telat mengembalikan!</h5>';
                }else{
                    echo '<h5 class="text-center text-success">Berhasil dikembalikan</h5>';
                }
            }else{
                echo '<h5 class="text-center text-danger">Kode tidak valid</h5>';
            }
        }

    }
?>