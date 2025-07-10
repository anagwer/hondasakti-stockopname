<?php
    require_once 'dbcon.php';
    $id_detailjual = $_GET['id_detailjual'];
    $no_nota = $_GET['no_nota'];
    $conn->query("delete from detailjual where id_detailjual='$id_detailjual'") or die(mysql_error());
	echo "<script>window.location.href='detail_jual.php?no_nota=".$no_nota."';</script>";
?>