<?php
    require_once 'dbcon.php';
    if (isset ($_POST ['proses'])){
    $no_nota=$_POST['no_nota'];
    $id_beli=$_POST['id_beli'];
    $id_user=$_POST['id_user'];    
    $ttl=$_POST['ttl'];  
    $query4 = $conn->query("SELECT COUNT(*) as jml FROM pembelian where no_nota = '$no_nota'");
    $row4 = $query4->fetch_array();
    if($row4['jml']==0){
        
    $query3 = $conn->query("SELECT * FROM detailbeli where id_beli='$id_beli'");
    while($row3 = $query3->fetch_array()){
        $id_detailbeli=$row3['id_detailbeli'];
        $id_barang=$row3['id_barang'];
        $jml_beli=$row3['jml_beli'];
        $query1 = $conn->query("SELECT * FROM barang where id_barang='$id_barang'");
        $row1 = $query1->fetch_array();
		$stok = $row1['stok']+$jml_beli;
        $total=$jml_beli * $harga;
        $conn->query("UPDATE barang SET stok = '$stok' WHERE id_barang = '$id_barang'")or die(mysql_error());
    }
    
        $conn->query("UPDATE detailbeli SET no_nota = '$no_nota' WHERE id_beli = '$id_beli'")or die(mysql_error());
        $conn->query("UPDATE pembelian SET total = '$ttl', no_nota = '$no_nota' WHERE id_beli = '$id_beli'")or die(mysql_error());
        echo "<script>window.location.href='pembelian.php';</script>";
    }else{
        echo "<script>alert('No Nota sudah ada!');</script>";
        echo "<script>window.location.href='detail_beli.php?id_beli=".$id_beli."';</script>";
    }
    
    }		

    if (isset ($_POST ['tambah'])){
    $id_beli=$_POST['id_beli'];
    $no_nota=$_POST['no_nota'];
    $id_user=$_POST['id_user'];
    $id_barang=$_POST['id_barang'];
    $jml_beli=$_POST['jml_beli'];

    $query1 = $conn->query("SELECT * FROM barang where id_barang='$id_barang'");
    $row1 = $query1->fetch_array();
    $nm_barang=$row1['nm_barang'];
    
    $query2 = $conn->query("SELECT *,COUNT(*) as jml  FROM detailbeli where id_barang='$id_barang' and id_beli='$id_beli'");
    $row2 = $query2->fetch_array();
    if($row2['jml']==0){
        $conn->query("INSERT INTO detailbeli values(null,'$no_nota','$id_beli','$id_barang','$jml_beli','$harga')")or die(mysql_error());
        echo "<script>window.location.href='detail_beli.php?id_beli=".$id_beli."';</script>";
    }else{
        $total=$row2['jml_beli']+$jml_beli;
        $id_detailbeli=$row2['id_detailbeli'];
        $conn->query("UPDATE detailbeli SET jml_beli = '$total' WHERE id_detailbeli = '$id_detailbeli'");
        echo "<script>window.location.href='detail_beli.php?id_beli=".$id_beli."';</script>";
    }
    
    }		
?>  