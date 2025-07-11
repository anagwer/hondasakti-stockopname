
<?php
	if(!$bool){
?>

<div class="modal fade" id="edit_barang<?php  echo $id_barang; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Edit</h5>
				<button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
			</div>
			
            <div class="modal-body">
				<form method = "post" enctype = "multipart/form-data">	
					<input type="hidden" name="id_barang" value="<?php echo $row['id_barang'] ?>">
				
					<div class="col-12">
						<label for="inputNanme4" class="form-label">Nama</label>
						<input type="text" class="form-control" name="nama" value="<?php echo $row['nm_barang'] ?>">
					</div>
					<div class="form-group">
							<label class="form-label">Deskripsi</label>
							<textarea class="tinymce-editor" name="deskripsi" value="<?php echo $row['deskripsi'];?>" placeholder="Masukkan detail uraian pembelanjaan....">
									</textarea>
					</div>
					<div class="col-12">
						<label for="inputNanme4" class="form-label">Stok</label>
						<input type="number" class="form-control" name="stok"  value="<?php echo $row['stok'] ?>">
					</div>
					<div class="col-12">
						<label for="inputNanme4" class="form-label">Harga Jual</label>
						<input type="number" class="form-control" name="hrg_jual"  value="<?php echo $row['hrg_jual'] ?>">
					</div>
					<br>
						<button name = "update" type="submit" class="btn btn-primary">Simpan</button>
					</form>
			</div>
            <div class="modal-footer">
                 <button type="button" class="btn  btn-secondary" data-dismiss="modal">Close</button>
                
            </div>
		</div>
	</div>
</div>
<!-- /.modal-content -->
                               
	<?php 
		require 'dbcon.php';
		
		if(ISSET($_POST['update'])){
			$id_barang = $_POST['id_barang'];
			$nama = $_POST['nama'];
			$deskripsi = $_POST['deskripsi'];
			$stok = $_POST['stok'];
			$hrg_jual = $_POST['hrg_jual'];
			$conn->query("UPDATE barang SET nm_barang = '$nama',deskripsi = '$deskripsi',stok = '$stok',hrg_jual = '$hrg_jual' WHERE id_barang = '$id_barang'")or die(mysql_error());
			echo "<script> window.location='barang.php' </script>";
		}	
	?>
								
<?php
	}
?>