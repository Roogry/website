<?php
    include 'model/koneksi.php';
    session_start();
    $resultPeminjam = $conn->query("SELECT nama_pegawai, id_pegawai FROM pegawai");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Peminjaman</title>
    <link rel="stylesheet" href="css//bootstrap.min.css">
</head>
<body>
    <?php include 'header.php' ?>
    <div class="container pt-5">
        <form action="" method="POST">
            <!-- invent -->
            <div class="card mt-2">
                <div class="card-body row">
                    <div class="col-md-10">
                        <select class="form-control" name="invent">
                        <?php
                            $result = $conn->query("SELECT * FROM inventaris");
                            if($result){
                                while($row = $result->fetch()){?>
                                    <option value="<?=$row['id_inventaris']?>"><?=$row['nama']?> </option>
                                    <?php
                                }
                            }
                        ?>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <input type="number" name="jumlah" min="0"  class="form-control" placeholder="jumlah" required>
                    </div>
                </div>
            </div>                        

            <div class="form-group mt-5">
                <label>Tanggal Kembali</label>
                <input type="date" name="tanggal" class="form-control text-center" required>
            </div>

            <div class="row mt-5">
                <div class="col-md-8 mt-auto">
                    <?php if($_SESSION["level"] != "3"){ ?>
                        <div class="form-group mb-0">
                            <label>Nama Peminjam</label>
                            <select class="form-control" name="peminjam">
                            <option value="0">Pilih Peminjam</option>
                            <?php
                                if($resultPeminjam){
                                    while($row = $resultPeminjam->fetch()){ ?> 
                                        <option value="<?=$row['id_pegawai']?>"><?=$row['nama_pegawai']?> </option>
                                        <?php
                                    }
                                }
                            ?>
                            </select>
                        </div>
                    <?php } ?>
                </div>
                <button type="submit" name="pinjam" class="btn btn-success col-md-4 mt-auto">Pinjam</button>
            </div>
        </form>
    </div>
</body>
</html>
<?php
    if(isset($_POST ['pinjam'])){

        if($_SESSION["level"] == "3"){
            $id_pegawai = $_SESSION["id"];
        }else{
            $id_pegawai = $_POST['peminjam'];
        }

        $invent = $_POST['invent'];
        $jumlah = $_POST['jumlah'];
        $tgl = $_POST['tanggal'];

        $cekPinjaman = $conn->query("CALL cekPinjam('$id_pegawai')");

        if($cekPinjaman->rowCount() > 0){
            echo '<h5 class="text-center text-danger mt-5">Pegawai masih memiliki pinjaman!</h5>';
        }else{
            $string = substr(str_shuffle("0123456789"), 0, 8);
            $kode = "PN".$string;
            $setPinjam = $conn->query("INSERT INTO peminjaman (id_pegawai, kode_peminjaman, tanggal_kembali) VALUES ('$id_pegawai', '$kode', '$tgl')");

            $idPeminjaman = $conn->lastInsertId();

            $setDetailPinjam = $conn->query("INSERT INTO detail_pinjam (id_inventaris, id_peminjaman, jumlah) VALUES ('$invent', '$idPeminjaman', '$jumlah')");

            if($setDetailPinjam && $setPinjam){
                echo '<h5 class="text-center text-success mt-5">Berhasil Meminjam</h5>';
            }
        }
    }
?>