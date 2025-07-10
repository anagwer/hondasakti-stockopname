<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
        <div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Tambah User</h5>
				<button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
			</div>
										
										
            <div class="modal-body">
				<form method = "post" enctype = "multipart/form-data">	
				<div class="col-12">
                  <label for="inputNanme4" class="form-label">Nama User</label>
                  <input type="text" class="form-control" name="nama" required>
                </div>
				<div class="col-12">
                  <label for="inputNanme4" class="form-label">Username</label>
                  <input type="text" class="form-control" name="username" required>
                </div>
				<div class="col-12">
                  <label for="inputNanme4" class="form-label">Password</label>
                  <input type="password" class="form-control" name="password" required>
                </div>
				<div class="col-12">
                  <label for="inputNanme4" class="form-label">Foto</label>
                  <input type="file" name="image"  class="form-control" required/>
                </div>
				<br>
					<button name = "save" type="submit" class="btn btn-primary">Simpan</button>
				</form>  
			</div>
            <div class="modal-footer">
              <button type="button" class="btn  btn-secondary" data-dismiss="modal">Close</button>
            </div>
										
												
			<?php 
				require_once 'dbcon.php';
				
				if (isset ($_POST ['save'])){
					$nama=$_POST['nama'];
					$username=$_POST['username'];
					$password=md5($_POST['password']);
					if (in_array($_FILES['image']['type'], ['image/jpeg', 'image/jpg', 'image/webp', 'image/png'])) {
					$image_name = addslashes($_FILES['image']['name']);
                    $image_size = $_FILES['image']['size'];
                    
                    $upload_dir = "upload/"; 
                    $target_file = $upload_dir . basename($image_name);
					$image_location = $image_name;
					
					$conn->query("INSERT INTO user values(null,'$nama','$username','$password','Admin','$image_location')")or die(mysql_error());
					} else {
						echo "<script>alert('Hanya file dengan ekstensi jpg, jpeg, webp, atau png yang diizinkan.');</script>";
					}
				}						
			?>					
        </div>
                                   
<!-- /.modal-content -->
                                
	</div>
                               
<!-- /.modal-dialog -->
								
</div>
