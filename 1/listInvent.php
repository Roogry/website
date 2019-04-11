<?php
    include 'model/koneksi.php';
    include 'model/cekSession.php';

    $invent = $conn->query("SELECT * FROM inventaris WHERE jumlah != 0");
?>

<!DOCTYPE html>
<html>
<head>
    <title>List Inventaris</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>

    <?php include 'header.php' ?>

    <div class="container pt-5">
        <?php
            if($invent){
                while($row = $invent->fetch()){?>
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="row">
                                <a class="card-title col-md-10 mb-0 text-dark" href="setInvent.php?id=<?=$row['id_inventaris']?>"><h5 ><?=$row['nama']?></h5></a> 
                                <p class="card-text col-md-2 mb-0 text-right">
                                Tersisa <?=$row['jumlah']?>
                                <a class="badge badge-danger ml-3" href="delInvent.php?id=<?=$row['id_inventaris']?>">x</a>
                                </p>
                            </div>
                        </div>    
                    </div>
                <?php
                }
            }
        ?>

        <a class="btn btn-success col-md-12" href="setInvent.php">Tambah Inventaris</a>

    </div>
</body>
</html>

<?php
    if(isset($_GET['msg'])){
        $msg = $_GET['msg'];
        echo '<h5 class="text-center text-primary">' . $msg .'</h5>';
    }
?>