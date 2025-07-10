
<?php
	if(!$bool){
?>

<div class="modal fade" id="edit_user<?php  echo $id_user; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Edit User</h5>
				<button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
			</div>
			
            <div class="modal-body">
				<form method = "post" enctype = "multipart/form-data">	
					<input type="hidden" name="id_user" value="<?php echo $row['id_user'] ?>">
				
					<div class="col-12">
						<label for="inputNanme4" class="form-label">Nama User</label>
						<input type="text" class="form-control" name="nama" value="<?php echo $row['nama'] ?>">
					</div>
					<div class="col-12">
						<label for="inputNanme4" class="form-label">Username</label>
						<input type="text" class="form-control" name="username"  value="<?php echo $row['username'] ?>">
					</div>
					<div class="col-12">
						<label for="inputNanme4" class="form-label">Password</label>
						<input type="password" class="form-control" name="password"  value="<?php echo $row['password'] ?>">
					</div>
					<div class="col-12">
					<label for="inputNanme4" class="form-label">Foto</label>
					<input type="file" name="image"  class="form-control"/>
					</div><br>
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
			$bool = true;
			$id_user=$_POST['id_user'];
			$nama=$_POST['nama'];
			$username=$_POST['username'];

			$password=$_POST['password'];
			$password1=md5($_POST['password']);
            $query1 = $conn->query("SELECT * FROM user WHERE id_user='$id_user'");
            $row1 = $query1->fetch_array();

            $file=$_FILES['image']['name'];
            if (empty($file)){
                //jika password sama
                if ($password==$row1['password']){
                    $conn->query("UPDATE user SET nama = '$nama',username = '$username' WHERE id_user = '$id_user'")or die(mysql_error());
                    echo "<script> window.location='user.php' </script>";
                }else{
                    $conn->query("UPDATE user SET nama = '$nama',username = '$username',password = '$password1' WHERE id_user = '$id_user'")or die(mysql_error());
                    echo "<script> window.location='user.php' </script>";
                }
            }else{
                if (in_array($_FILES['image']['type'], ['image/jpeg', 'image/jpg', 'image/webp', 'image/png'])) {
                    $image_name = addslashes($_FILES['image']['name']);
                    $image_size = $_FILES['image']['size'];
                    
                    // Pastikan direktori upload ada dan sudah dibuat sebelumnya
                    $upload_dir = "upload/"; // Ubah sesuai dengan direktori penyimpanan Anda
                    $target_file = $upload_dir . basename($image_name);
                    
                    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                        $image_location = $image_name;
                        //jika password sama
                        if ($password==$row1['password']){
                            $conn->query("UPDATE user SET nama = '$nama',username = '$username',foto = '$image_location' WHERE id_user = '$id_user'")or die(mysql_error());
                            echo "<script> window.location='user.php' </script>";
                        }else{
                            $conn->query("UPDATE user SET nama = '$nama',username = '$username',password = '$password1',foto = '$image_location' WHERE id_user = '$id_user'")or die(mysql_error());
                            echo "<script> window.location='user.php' </script>";
                        }
                    } else {
                        echo "<script>alert('Gagal mengunggah file.');</script>";
                    }
                } else {
                    echo "<script>alert('Hanya file dengan ekstensi jpg, jpeg, webp, atau png yang diizinkan.');</script>";
                }
            }
		}	
	?>
								
<?php
	}
?>