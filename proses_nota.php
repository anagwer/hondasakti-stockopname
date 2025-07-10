<?php
    require_once 'dbcon.php';
    if (isset ($_POST ['proses'])){
    $no_nota=$_POST['no_nota'];
    $id_user=$_POST['id_user'];    
    $member=$_POST['member'];
    $total_diskon=$_POST['total_diskon'];

    $query3 = $conn->query("SELECT * FROM detailjual where no_nota_jual='$no_nota'");
    while($row3 = $query3->fetch_array()){
        $id_detailjual=$row3['id_detailjual'];
        $id_barang=$row3['id_barang'];
        $jml_beli=$row3['jml_beli'];
        $query1 = $conn->query("SELECT * FROM barang where id_barang='$id_barang'");
        $row1 = $query1->fetch_array();
		$stok = $row1['stok']-$jml_beli;
        $harga=$row1['hrg_jual'];
        $total=$jml_beli * $harga;
        if($member == "Member"){
            $diskon=10/100*$total;
        }else{
            $diskon=0;
        }
        $conn->query("UPDATE detailjual SET diskon = '$diskon' WHERE id_detailjual = '$id_detailjual'");
        $conn->query("UPDATE barang SET stok = '$stok' WHERE id_barang = '$id_barang'")or die(mysql_error());
    }
    
    $conn->query("UPDATE penjualan SET total = '$total_diskon',status = '$member' WHERE nota = '$no_nota'")or die(mysql_error());
    
    echo "<script>window.location.href='penjualan.php';</script>";
    }		

    if (isset ($_POST ['tambah'])){
    $no_nota=$_POST['no_nota'];
    $id_user=$_POST['id_user'];
    $id_barang=$_POST['id_barang'];
    $jml_beli=$_POST['jml_beli'];

    $query1 = $conn->query("SELECT * FROM barang where id_barang='$id_barang'");
    $row1 = $query1->fetch_array();
    $hrg_jual=$row1['hrg_jual'];

    $query2 = $conn->query("SELECT *,COUNT(*) as jml  FROM detailjual where id_barang='$id_barang' and no_nota_jual='$no_nota'");
    $row2 = $query2->fetch_array();
    if($row2['jml']==0){
        $conn->query("INSERT INTO detailjual values(null,'$id_barang','$hrg_jual','$jml_beli','0','$id_user','$no_nota')")or die(mysql_error());
        echo "<script>window.location.href='detail_jual.php?no_nota=".$no_nota."';</script>";
    }else{
        $total=$row2['jml_beli']+$jml_beli;
        $id_detailjual=$row2['id_detailjual'];
        $conn->query("UPDATE detailjual SET jml_beli = '$total', hrg_jual = '$hrg_jual' WHERE id_detailjual = '$id_detailjual'");
        echo "<script>window.location.href='detail_jual.php?no_nota=".$no_nota."';</script>";
    }
    
    }		
?>  