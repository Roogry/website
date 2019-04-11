<?php
    include 'model/koneksi.php';

    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $del = $conn->query("DELETE FROM inventaris WHERE id_inventaris='$id'");

        if($del){
            header("Location: listInvent.php?msg=Berhasil Delete");
        }else{
            header("Location: listInvent.php?msg=Gagal Delete");
 
        }
    }
?>