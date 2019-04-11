<?php 
    include 'model/koneksi.php';
    include 'model/cekSession.php';
    include 'header.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Laporan Peminjaman</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">

        <?php
            if(isset($_POST['submit'])){
                $dFrom = $_POST['dFrom'];
                $dTo = $_POST['dTo'];
        
                $dTo = strtotime($dTo);
                $dTo = strtotime("+1 day", $dTo);
                $dTo = date('Y-m-d', $dTo);
                
                $report = $conn->query("CALL getReport('$dFrom', '$dTo')");
        
                if($report){
                    while($row = $report->fetch()){?>
                        <div class="card mb-3 mx-auto">
                            <div class="card-body p-3">
                                <div class="row">
                                    <div class="col-md-10">
                                        <h5><?=$row['nama']?></h5>
                                        <p class="mb-0"><?=$row['nama_pegawai']?></p>
                                    </div>
                                    <p class="card-text col-md-2 text-right my-auto">
                                    Jumlah <?=$row['jumlah']?>
                                    </p>
                                </div>
                            </div>    
                        </div>
                    <?php
                    }
                }
            }
        ?>

        <form action="" method="post" class="mt-5">
            <div class="form-group row">
                <div class="col">
                    <label>Dari Tanggal</label>
                    <input type="date" name="dFrom" class="form-control text-center" required>
                </div>
                <div class="col">
                    <label>Sampai Tanggal</label>
                    <input type="date" name="dTo" class="form-control text-center" required>
                </div>
            </div>
            <button class="btn-success btn col-md-12" type="submit" name="submit">Tampilkan Laporan</button>
        </form>
    </div>
</body>
</html>