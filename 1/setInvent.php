<?php
    include 'model/koneksi.php';
    include 'model/cekSession.php';

    $jenis = $conn->query("SELECT * FROM jenis");
    $ruang = $conn->query("SELECT * FROM ruang");

    $nama = "";
    $kondisi = "";
    $ket = "";
    $jumlah = "";
    $idJenis = "";
    $idRuang = "";
    $kode = "";

    if(isset($_POST['submit']) || isset($_POST['update']) ){
        $nama = $_POST['nama'];
        $kondisi = $_POST['kondisi'];
        $ket = $_POST['keterangan'];
        $jumlah = $_POST['jumlah'];
        $idJenis = $_POST['jenis'];
        $idRuang = $_POST['ruang'];
        $idPetugas = $_SESSION['id'];

        if(isset($_POST['submit'])){
            $lastId = $conn->query("SELECT MAX(id_inventaris) FROM inventaris")->fetch();

            $kode = "IS";
            for($i=0; $i<4-strlen($lastId[0]); $i++){
                $kode .= "0";
            } 
            $kode .= ++$lastId[0];
    
            $setInvent = $conn->query("INSERT INTO inventaris (nama, kondisi, keterangan, jumlah, id_jenis, id_ruang, kode_inventaris, id_petugas) VALUE ('$nama', '$kondisi', '$ket', '$jumlah', '$idJenis', '$idRuang', '$kode', '$idPetugas') ");
        }else{
            $id = $_GET['id'];

            $putInvent = $conn->query("UPDATE inventaris SET nama = '$nama', kondisi ='$kondisi', keterangan ='$ket', jumlah ='$jumlah', id_jenis ='$idJenis' , id_ruang = '$idRuang', id_petugas = '$idPetugas' WHERE id_inventaris = '$id'");
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Inventaris</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
    
    <?php include 'header.php' ?>

    <div class="container mt-5">

        <?php
            if(isset($_GET['id'])){
                $id = $_GET['id'];
                $invent =  $conn->query("SELECT * FROM inventaris WHERE id_inventaris='$id'");

                while($rowInvent = $invent->fetch()){
                    $nama = $rowInvent['nama'];
                    $kondisi = $rowInvent['kondisi'];
                    $ket = $rowInvent['keterangan'];
                    $jumlah = $rowInvent['jumlah'];
                    $idJenis = $rowInvent['id_jenis'];
                    $idRuang = $rowInvent['id_ruang'];
                    $kode = $rowInvent['kode_inventaris'];

                }
            }
        ?>

        <form action="" method="POST">
            <div class="form-group row">
                <div class="col-md-10">
                    <input  name="nama" class="form-control" placeholder="Nama Inventaris" value="<?=$nama?>" required>
                </div>
                <div class="col-md-2">
                    <input type="number" name="jumlah" min="0"  class="form-control" placeholder="jumlah" value="<?=$jumlah?>" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <select class="form-control" name="jenis">
                    <?php while($rowJenis =  $jenis->fetch()){ ?>
                        <option value="<?=$rowJenis['id_jenis']?>" <?php if($idJenis == $rowJenis['id_jenis']) echo "selected";?>><?=$rowJenis['nama_jenis']?></option>
                    <?php } ?>
                    </select>
                </div>

                <div class="form-group col-md-6">
                    <select class="form-control" name="ruang">
                    <?php while($rowRuang =  $ruang->fetch()){ ?>
                        <option value="<?=$rowRuang['id_ruang']?>" <?php if($idRuang == $rowRuang['id_ruang']) echo "selected";?>><?=$rowRuang['nama_ruang']?></option>
                    <?php } ?>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <select class="form-control" name="kondisi">
                    <option value="1" <?php if($kondisi == "1") echo "selected";?>>Baru</option>
                    <option value="2" <?php if($kondisi == "2") echo "selected";?>>Baik</option>
                    <option value="3" <?php if($kondisi == "3") echo "selected";?>>Kurang Baik</option>
                    <option value="4" <?php if($kondisi == "4") echo "selected";?>>Rusak</option>
                </select>
            </div>

            <div class="form-group">
                <select class="form-control" name="keterangan">
                    <option <?php if($kondisi == "Barang Pakai Habis") echo "selected";?> >Barang Pakai Habis</option>
                    <option <?php if($kondisi == "Barang Pinjam") echo "selected";?> >Barang Pinjam</option>
                </select>
            </div>

            <?php if(isset($_GET['id'])){?>
                <button name="update" type="submit" class="btn btn-success col-md-3">Update</button>
            <?php }else{ ?>        
                <button name="submit" type="submit" class="btn btn-success col-md-3">Tambah</button>
            <?php } ?>
        
        </form>
        
    </div>

</body>
</html>

<?php
    if(isset($_POST['submit'])){
        if($setInvent){
            echo '<h5 class="text-center text-success">Berhasil Ditambahkan</h5>';
        }else{
            echo '<h5 class="text-center text-danger">Gagal Menambah Data</h5>';
        }
    }
?>